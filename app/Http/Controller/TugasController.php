<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\Proyek;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index(Request $request)
    {
        $query = Tugas::with('proyek');
        
        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_tugas', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }
        
        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Sort functionality
        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'asc');
        
        $allowedSorts = ['id', 'nama_tugas', 'status', 'created_at'];
        if (in_array($sortField, $allowedSorts)) {
            $query->orderBy($sortField, $sortDirection);
        }
        
        $tugas = $query->paginate(10);
        
        return view('tugas.index', compact('tugas'));
    }

    public function create()
    {
        $proyeks = Proyek::all();
        return view('tugas.create', compact('proyeks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'proyek_id' => 'required|exists:proyeks,id',
            'nama_tugas' => 'required|string|max:255',
            'status' => 'required|in:selesai,dalam proses,tertunda',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx|max:5120'
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/tugas', $fileName, 'public');
            
            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = $file->getSize();
        }

        Tugas::create($data);

        return redirect()->route('tugas.index')->with('success', 'Tugas baru berhasil ditambahkan.');
    }

    public function edit(Tugas $tugas)
    {
        $proyeks = Proyek::all();
        return view('tugas.edit', [
        'tugas' => $tugas,
        'proyeks' => $proyeks
        ]);
    }

    public function update(Request $request, Tugas $tugas)
    {
        $request->validate([
            'proyek_id' => 'required|exists:proyeks,id',
            'nama_tugas' => 'required|string|max:255',
            'status' => 'required|in:selesai,dalam proses,tertunda',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx|max:5120'
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($tugas->file_path && file_exists(storage_path('app/public/' . $tugas->file_path))) {
                unlink(storage_path('app/public/' . $tugas->file_path));
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/tugas', $fileName, 'public');
            
            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = $file->getSize();
        }

        $tugas->update($data);

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Tugas $tugas)
    {
        $tugas->delete();

        return redirect()->route('tugas.index')->with('success', 'Tugas berhasil dihapus.');
    }
}
