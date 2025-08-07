@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Daftar Proyek</h1>
            <p class="text-muted">Kelola dan monitor semua proyek Anda</p>
        </div>
        <a href="{{ route('proyeks.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Proyek
        </a>
    </div>

    <!-- Search and Filter Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pencarian & Filter</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('proyeks.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Cari Proyek</label>
                    <input type="text" name="search" class="form-control" placeholder="Nama proyek..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Urutkan</label>
                    <select name="sort" class="form-select">
                        <option value="id" {{ request('sort') == 'id' ? 'selected' : '' }}>ID</option>
                        <option value="nama_proyek" {{ request('sort') == 'nama_proyek' ? 'selected' : '' }}>Nama Proyek</option>
                        <option value="status" {{ request('sort') == 'status' ? 'selected' : '' }}>Status</option>
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Tanggal</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('proyeks.index') }}" class="btn btn-secondary">
                        <i class="fas fa-refresh"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Export Buttons -->
    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('proyeks.export', ['format' => 'excel']) }}" class="btn btn-success">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
        <a href="{{ route('proyeks.export', ['format' => 'pdf']) }}" class="btn btn-danger">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
    </div>

    <!-- Proyek Table Card -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Proyek</h6>
            <span class="badge bg-secondary">{{ $proyeks->total() }} total</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <a href="{{ route('proyeks.index', ['sort' => 'id', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-dark">
                                    ID @if(request('sort') == 'id') {!! request('direction') == 'asc' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>' !!} @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('proyeks.index', ['sort' => 'nama_proyek', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-dark">
                                    Nama Proyek @if(request('sort') == 'nama_proyek') {!! request('direction') == 'asc' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>' !!} @endif
                                </a>
                            </th>
                            <th>Status</th>
                            <th>File</th>
                            <th>Dibuat</th>
                            <th>Diupdate</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($proyeks as $proyek)
                        <tr>
                            <td><span class="badge bg-secondary">#{{ $proyek->id }}</span></td>
                            <td>
                                <strong>{{ $proyek->nama_proyek }}</strong>
                                <br>
                                <small class="text-muted">{{ Str::limit($proyek->deskripsi ?? 'Tidak ada deskripsi', 50) }}</small>
                            </td>
                            <td>
                                @php
                                    $statusClass = [
                                        'aktif' => 'primary',
                                        'selesai' => 'success',
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusClass[$proyek->status] ?? 'secondary' }}">
                                    {{ ucfirst($proyek->status) }}
                                </span>
                            </td>
                            <td>
                                @if($proyek->file_path)
                                    <a href="{{ asset('storage/' . $proyek->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-file-download"></i>
                                    </a>
                                @else
                                    <span class="text-muted"><i class="fas fa-minus"></i></span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">{{ $proyek->created_at ? $proyek->created_at->format('d/m/Y') : '-' }}</small>
                            </td>
                            <td>
                                <small class="text-muted">{{ $proyek->updated_at ? $proyek->updated_at->format('d/m/Y') : '-' }}</small>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('proyeks.edit', $proyek->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('proyeks.destroy', $proyek->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Tidak ada proyek ditemukan</h5>
                                <p class="text-muted">Silakan tambahkan proyek baru untuk memulai.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Menampilkan {{ $proyeks->firstItem() ?? 0 }} sampai {{ $proyeks->lastItem() ?? 0 }} dari {{ $proyeks->total() }} proyek
                </div>
                <div>
                    {{ $proyeks->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
