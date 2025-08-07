

<?php $__env->startSection('content'); ?>
<div class="container">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Daftar Tugas</h1>
            <p class="text-muted">Kelola dan monitor semua tugas proyek Anda</p>
        </div>
        <a href="<?php echo e(route('tugas.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Tugas
        </a>
    </div>

    <!-- Search and Filter Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pencarian & Filter</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('tugas.index')); ?>" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Cari Tugas</label>
                    <input type="text" name="search" class="form-control" placeholder="Nama tugas..." value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="belum_mulai" <?php echo e(request('status') == 'belum_mulai' ? 'selected' : ''); ?>>Belum Mulai</option>
                        <option value="sedang_dikerjakan" <?php echo e(request('status') == 'sedang_dikerjakan' ? 'selected' : ''); ?>>Sedang Dikerjakan</option>
                        <option value="selesai" <?php echo e(request('status') == 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Urutkan</label>
                    <select name="sort" class="form-select">
                        <option value="id" <?php echo e(request('sort') == 'id' ? 'selected' : ''); ?>>ID</option>
                        <option value="nama_tugas" <?php echo e(request('sort') == 'nama_tugas' ? 'selected' : ''); ?>>Nama Tugas</option>
                        <option value="status" <?php echo e(request('sort') == 'status' ? 'selected' : ''); ?>>Status</option>
                        <option value="created_at" <?php echo e(request('sort') == 'created_at' ? 'selected' : ''); ?>>Tanggal</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="<?php echo e(route('tugas.index')); ?>" class="btn btn-secondary">
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($tugas->total()); ?></div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($tugas->where('status', 'selesai')->count()); ?></div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($tugas->where('status', 'dalam proses')->count()); ?></div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo e($tugas->where('status', 'tertunda')->count()); ?></div>
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
            <span class="badge bg-secondary"><?php echo e($tugas->total()); ?> total</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <a href="<?php echo e(route('tugas.index', ['sort' => 'id', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])); ?>" class="text-decoration-none text-dark">
                                    ID <?php if(request('sort') == 'id'): ?> <?php echo request('direction') == 'asc' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>'; ?> <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?php echo e(route('tugas.index', ['sort' => 'nama_tugas', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])); ?>" class="text-decoration-none text-dark">
                                    Nama Tugas <?php if(request('sort') == 'nama_tugas'): ?> <?php echo request('direction') == 'asc' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>'; ?> <?php endif; ?>
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
                        <?php $__empty_1 = true; $__currentLoopData = $tugas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><span class="badge bg-secondary">#<?php echo e($tug->id); ?></span></td>
                            <td>
                                <strong><?php echo e($tug->nama_tugas); ?></strong>
                                <br>
                                <small class="text-muted"><?php echo e(Str::limit($tug->deskripsi ?? 'Tidak ada deskripsi', 50)); ?></small>
                            </td>
                            <td>
                                <?php
                                    $statusClass = [
                                        'tertunda' => 'warning',
                                        'dalam proses' => 'info',
                                        'selesai' => 'success'
                                    ];
                                ?>
                                <span class="badge bg-<?php echo e($statusClass[$tug->status] ?? 'secondary'); ?>">
                                    <?php echo e(ucfirst($tug->status)); ?>

                                </span>
                            </td>
                            <td>
                                <a href="<?php echo e(route('proyeks.show', $tug->proyek->id)); ?>" class="text-decoration-none">
                                    <?php echo e($tug->proyek->nama_proyek); ?>

                                </a>
                            </td>
                            <td>
                                <?php if($tug->file_path): ?>
                                    <a href="<?php echo e(asset('storage/' . $tug->file_path)); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-file-download"></i>
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted"><i class="fas fa-minus"></i></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <small class="text-muted"><?php echo e($tug->created_at ? $tug->created_at->format('d/m/Y') : '-'); ?></small>
                            </td>
                            <td>
                                <small class="text-muted"><?php echo e($tug->updated_at ? $tug->updated_at->format('d/m/Y') : '-'); ?></small>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="<?php echo e(route('tugas.edit', $tug->id)); ?>" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('tugas.destroy', $tug->id)); ?>" method="POST" style="display: inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Tidak ada tugas ditemukan</h5>
                                <p class="text-muted">Silakan tambahkan tugas baru untuk memulai.</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Menampilkan <?php echo e($tugas->firstItem() ?? 0); ?> sampai <?php echo e($tugas->lastItem() ?? 0); ?> dari <?php echo e($tugas->total()); ?> tugas
                </div>
                <div>
                    <?php echo e($tugas->appends(request()->except('page'))->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\monitoring-proyek\resources\views/tugas/index.blade.php ENDPATH**/ ?>