@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Daftar Tugas</h1>
            <p class="text-muted">Kelola dan monitor semua tugas proyek Anda</p>
        </div>
        <a href="{{ route('tugas.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Tugas
        </a>
    </div>

    <!-- Search and Filter Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pencarian & Filter</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('tugas.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Cari Tugas</label>
                    <input type="text" name="search" class="form-control" placeholder="Nama tugas..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="belum_mulai" {{ request('status') == 'belum_mulai' ? 'selected' : '' }}>Belum Mulai</option>
                        <option value="sedang_dikerjakan" {{ request('status') == 'sedang_dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Urutkan</label>
                    <select name="sort" class="form-select">
                        <option value="id" {{ request('sort') == 'id' ? 'selected' : '' }}>ID</option>
                        <option value="nama_tugas" {{ request('sort') == 'nama_tugas' ? 'selected' : '' }}>Nama Tugas</option>
                        <option value="status" {{ request('sort') == 'status' ? 'selected' : '' }}>Status</option>
                        <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Tanggal</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('tugas.index') }}" class="btn btn-secondary">
                        <i class="fas fa-refresh"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Statistics Card -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Tugas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tugas->total() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tasks fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Tugas Selesai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tugas->where('status', 'selesai')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Sedang Dikerjakan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tugas->where('status', 'dalam proses')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Belum Mulai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tugas->where('status', 'tertunda')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hourglass-start fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tugas Table Card -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Tugas</h6>
            <span class="badge bg-secondary">{{ $tugas->total() }} total</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <a href="{{ route('tugas.index', ['sort' => 'id', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-dark">
                                    ID @if(request('sort') == 'id') {!! request('direction') == 'asc' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>' !!} @endif
                                </a>
                            </th>
                            <th>
                                <a href="{{ route('tugas.index', ['sort' => 'nama_tugas', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}" class="text-decoration-none text-dark">
                                    Nama Tugas @if(request('sort') == 'nama_tugas') {!! request('direction') == 'asc' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>' !!} @endif
                                </a>
                            </th>
                            <th>Status</th>
                            <th>Proyek</th>
                            <th>File</th>
                            <th>Dibuat</th>
                            <th>Diupdate</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tugas as $tug)
                        <tr>
                            <td><span class="badge bg-secondary">#{{ $tug->id }}</span></td>
                            <td>
                                <strong>{{ $tug->nama_tugas }}</strong>
                                <br>
                                <small class="text-muted">{{ Str::limit($tug->deskripsi ?? 'Tidak ada deskripsi', 50) }}</small>
                            </td>
                            <td>
                                @php
                                    $statusClass = [
                                        'tertunda' => 'warning',
                                        'dalam proses' => 'info',
                                        'selesai' => 'success'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusClass[$tug->status] ?? 'secondary' }}">
                                    {{ ucfirst($tug->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('proyeks.show', $tug->proyek->id) }}" class="text-decoration-none">
                                    {{ $tug->proyek->nama_proyek }}
                                </a>
                            </td>
                            <td>
                                @if($tug->file_path)
                                    <a href="{{ asset('storage/' . $tug->file_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-file-download"></i>
                                    </a>
                                @else
                                    <span class="text-muted"><i class="fas fa-minus"></i></span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">{{ $tug->created_at ? $tug->created_at->format('d/m/Y') : '-' }}</small>
                            </td>
                            <td>
                                <small class="text-muted">{{ $tug->updated_at ? $tug->updated_at->format('d/m/Y') : '-' }}</small>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('tugas.edit', $tug->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('tugas.destroy', $tug->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Tidak ada tugas ditemukan</h5>
                                <p class="text-muted">Silakan tambahkan tugas baru untuk memulai.</p>
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
                    Menampilkan {{ $tugas->firstItem() ?? 0 }} sampai {{ $tugas->lastItem() ?? 0 }} dari {{ $tugas->total() }} tugas
                </div>
                <div>
                    {{ $tugas->appends(request()->except('page'))->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
