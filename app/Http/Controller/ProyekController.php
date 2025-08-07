<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class ProyekController extends Controller
{
    public function index(Request $request)
    {
        $query = Proyek::query();
        
        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_proyek', 'like', "%{$search}%")
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
        
        $allowedSorts = ['id', 'nama_proyek', 'status', 'created_at'];
        if (in_array($sortField, $allowedSorts)) {
            $query->orderBy($sortField, $sortDirection);
        }
        
        $proyeks = $query->paginate(10);
        
        return view('proyeks.index', compact('proyeks'));
    }

    public function create()
    {
        return view('proyeks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|in:aktif,selesai',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx|max:5120'
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/proyek', $fileName, 'public');
            
            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = $file->getSize();
        }

        Proyek::create($data);

        return redirect()->route('proyeks.index')->with('success', 'Proyek baru berhasil ditambahkan.');
    }

    public function edit(Proyek $proyek)
    {
        return view('proyeks.edit', compact('proyek'));
    }

    public function update(Request $request, Proyek $proyek)
    {
        $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required|in:aktif,selesai',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx|max:5120'
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($proyek->file_path && file_exists(storage_path('app/public/' . $proyek->file_path))) {
                unlink(storage_path('app/public/' . $proyek->file_path));
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/proyek', $fileName, 'public');
            
            $data['file_path'] = $filePath;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_type'] = $file->getClientMimeType();
            $data['file_size'] = $file->getSize();
        }

        $proyek->update($data);

        return redirect()->route('proyeks.index')->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Proyek $proyek)
    {
        $proyek->delete();

        return redirect()->route('proyeks.index')->with('success', 'Proyek berhasil dihapus.');
    }

    public function export($format)
    {
        $proyeks = Proyek::all();

if ($format === 'excel') {
    $filename = 'proyeks_' . date('Y-m-d') . '.csv';
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ];

    $callback = function () use ($proyeks) {
        $output = fopen('php://output', 'w');
        fputcsv($output, ['ID', 'Nama Proyek', 'Deskripsi', 'Status', 'Tanggal Dibuat', 'Tanggal Diupdate']);

        foreach ($proyeks as $proyek) {
            fputcsv($output, [
                $proyek->id,
                $proyek->nama_proyek,
                $proyek->deskripsi,
                $proyek->status,
                $proyek->created_at->format('Y-m-d H:i:s'),
                $proyek->updated_at->format('Y-m-d H:i:s')
            ]);
        }
        fclose($output);
    };

    return response()->stream($callback, 200, $headers);

        } elseif ($format === 'pdf') {
            $html = '<h1>Daftar Proyek</h1>';
            $html .= '<table border="1" cellpadding="5" cellspacing="0">';
            $html .= '<thead><tr><th>ID</th><th>Nama Proyek</th><th>Deskripsi</th><th>Status</th><th>Tanggal Dibuat</th></tr></thead>';
            $html .= '<tbody>';

            foreach ($proyeks as $proyek) {
                $html .= '<tr>';
                $html .= '<td>' . $proyek->id . '</td>';
                $html .= '<td>' . $proyek->nama_proyek . '</td>';
                $html .= '<td>' . $proyek->deskripsi . '</td>';
                $html .= '<td>' . $proyek->status . '</td>';
                $html .= '<td>' . $proyek->created_at->format('Y-m-d H:i:s') . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody></table>';

            $filename = 'proyeks_' . date('Y-m-d') . '.pdf';

            $mpdf = new Mpdf();
            $mpdf->WriteHTML($html);

            $pdfContent = $mpdf->Output($filename, \Mpdf\Output\Destination::STRING_RETURN);

            return response($pdfContent, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Content-Length' => strlen($pdfContent),
            ]);
        }

        return redirect()->route('proyeks.index')->with('error', 'Format export tidak valid.');
    }

    public function show(Proyek $proyek)
    {
        return view('proyeks.show', compact('proyek'));
    }
}
