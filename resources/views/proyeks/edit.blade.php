@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Proyek</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('proyeks.update', $proyek->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_proyek" class="form-label">Nama Proyek</label>
                            <input type="text" 
                                   class="form-control @error('nama_proyek') is-invalid @enderror" 
                                   id="nama_proyek" 
                                   name="nama_proyek" 
                                   value="{{ old('nama_proyek', $proyek->nama_proyek) }}" 
                                   required>
                            @error('nama_proyek')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="4" 
                                      required>{{ old('deskripsi', $proyek->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status" 
                                    required>
                                <option value="aktif" {{ $proyek->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="selesai" {{ $proyek->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">Upload File (Gambar/Dokumen)</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file" accept=".jpg,.jpeg,.png,.gif,.pdf,.doc,.docx,.xls,.xlsx">
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            @if($proyek->file_path)
                                <div class="mt-2">
                                    <small class="text-muted">File saat ini: {{ $proyek->file_name }}</small>
                                    <br>
                                    <a href="{{ asset('storage/' . $proyek->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat File</a>
                                </div>
                            @endif
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary me-md-2">Simpan Perubahan</button>
                            <a href="{{ route('proyeks.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
