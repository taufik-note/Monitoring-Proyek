@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Tugas</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('tugas.update', $tugas->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="proyek_id" class="form-label">Proyek</label>
                            <select class="form-select @error('proyek_id') is-invalid @enderror" id="proyek_id" name="proyek_id" required>
                                <option value="">Pilih Proyek</option>
                                @foreach($proyeks as $proyek)
                                    <option value="{{ $proyek->id }}" {{ $tugas->proyek_id == $proyek->id ? 'selected' : '' }}>
                                        {{ $proyek->nama_proyek }}
                                    </option>
                                @endforeach
                            </select>
                            @error('proyek_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama_tugas" class="form-label">Nama Tugas</label>
                            <input type="text" class="form-control @error('nama_tugas') is-invalid @enderror" id="nama_tugas" name="nama_tugas" value="{{ old('nama_tugas', $tugas->nama_tugas) }}" required>
                            @error('nama_tugas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="selesai" {{ $tugas->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dalam proses" {{ $tugas->status == 'dalam proses' ? 'selected' : '' }}>Dalam Proses</option>
                                <option value="tertunda" {{ $tugas->status == 'tertunda' ? 'selected' : '' }}>Tertunda</option>
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
                            
                            @if($tugas->file_path)
                                <div class="mt-2">
                                    <small class="text-muted">File saat ini: {{ $tugas->file_name }}</small>
                                    <br>
                                    <a href="{{ asset('storage/' . $tugas->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat File</a>
                                </div>
                            @endif
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary me-md-2">Simpan Perubahan</button>
                            <a href="{{ route('tugas.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
