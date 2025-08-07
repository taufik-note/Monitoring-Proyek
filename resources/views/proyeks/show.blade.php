@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Proyek</h1>
    <div class="card shadow">
        <div class="card-body">
            <h3>{{ $proyek->nama_proyek }}</h3>
            <p>{{ $proyek->deskripsi }}</p>
            <p>
                <strong>Status:</strong> 
                <span class="badge bg-{{ $proyek->status == 'aktif' ? 'primary' : 'success' }}">
                    {{ ucfirst($proyek->status) }}
                </span>
            </p>
            <p>
                <strong>File:</strong>
                @if($proyek->file_path)
                    <a href="{{ asset('storage/' . $proyek->file_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-file-download"></i> Download
                    </a>
                @else
                    <span class="text-muted">Tidak ada file</span>
                @endif
            </p>
            <p>
                <strong>Dibuat:</strong> {{ $proyek->created_at->format('d/m/Y H:i') }}<br>
                <strong>Diupdate:</strong> {{ $proyek->updated_at->format('d/m/Y H:i') }}
            </p>
            <a href="{{ route('proyeks.index') }}" class="btn btn-secondary me-2">Kembali ke Daftar Proyek</a>
            <a href="{{ route('tugas.index') }}" class="btn btn-outline-secondary">Kembali ke Daftar Tugas</a>
        </div>
    </div>
</div>
@endsection
