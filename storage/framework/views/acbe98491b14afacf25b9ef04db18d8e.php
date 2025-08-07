

<?php $__env->startSection('content'); ?>
<div class="container">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Daftar Proyek</h1>
            <p class="text-muted">Kelola dan monitor semua proyek Anda</p>
        </div>
        <a href="<?php echo e(route('proyeks.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Proyek
        </a>
    </div>

    <!-- Search and Filter Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pencarian & Filter</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('proyeks.index')); ?>" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Cari Proyek</label>
                    <input type="text" name="search" class="form-control" placeholder="Nama proyek..." value="<?php echo e(request('search')); ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="aktif" <?php echo e(request('status') == 'aktif' ? 'selected' : ''); ?>>Aktif</option>
                        <option value="selesai" <?php echo e(request('status') == 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Urutkan</label>
                    <select name="sort" class="form-select">
                        <option value="id" <?php echo e(request('sort') == 'id' ? 'selected' : ''); ?>>ID</option>
                        <option value="nama_proyek" <?php echo e(request('sort') == 'nama_proyek' ? 'selected' : ''); ?>>Nama Proyek</option>
                        <option value="status" <?php echo e(request('sort') == 'status' ? 'selected' : ''); ?>>Status</option>
                        <option value="created_at" <?php echo e(request('sort') == 'created_at' ? 'selected' : ''); ?>>Tanggal</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="<?php echo e(route('proyeks.index')); ?>" class="btn btn-secondary">
                        <i class="fas fa-refresh"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Export Buttons -->
    <div class="mb-3 d-flex gap-2">
        <a href="<?php echo e(route('proyeks.export', ['format' => 'excel'])); ?>" class="btn btn-success">
            <i class="fas fa-file-excel"></i> Export Excel
        </a>
        <a href="<?php echo e(route('proyeks.export', ['format' => 'pdf'])); ?>" class="btn btn-danger">
            <i class="fas fa-file-pdf"></i> Export PDF
        </a>
    </div>

    <!-- Proyek Table Card -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Proyek</h6>
            <span class="badge bg-secondary"><?php echo e($proyeks->total()); ?> total</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <a href="<?php echo e(route('proyeks.index', ['sort' => 'id', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])); ?>" class="text-decoration-none text-dark">
                                    ID <?php if(request('sort') == 'id'): ?> <?php echo request('direction') == 'asc' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>'; ?> <?php endif; ?>
                                </a>
                            </th>
                            <th>
                                <a href="<?php echo e(route('proyeks.index', ['sort' => 'nama_proyek', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])); ?>" class="text-decoration-none text-dark">
                                    Nama Proyek <?php if(request('sort') == 'nama_proyek'): ?> <?php echo request('direction') == 'asc' ? '<i class="fas fa-sort-up"></i>' : '<i class="fas fa-sort-down"></i>'; ?> <?php endif; ?>
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
                        <?php $__empty_1 = true; $__currentLoopData = $proyeks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proyek): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><span class="badge bg-secondary">#<?php echo e($proyek->id); ?></span></td>
                            <td>
                                <strong><?php echo e($proyek->nama_proyek); ?></strong>
                                <br>
                                <small class="text-muted"><?php echo e(Str::limit($proyek->deskripsi ?? 'Tidak ada deskripsi', 50)); ?></small>
                            </td>
                            <td>
                                <?php
                                    $statusClass = [
                                        'aktif' => 'primary',
                                        'selesai' => 'success',
                                    ];
                                ?>
                                <span class="badge bg-<?php echo e($statusClass[$proyek->status] ?? 'secondary'); ?>">
                                    <?php echo e(ucfirst($proyek->status)); ?>

                                </span>
                            </td>
                            <td>
                                <?php if($proyek->file_path): ?>
                                    <a href="<?php echo e(asset('storage/' . $proyek->file_path)); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-file-download"></i>
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted"><i class="fas fa-minus"></i></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <small class="text-muted"><?php echo e($proyek->created_at ? $proyek->created_at->format('d/m/Y') : '-'); ?></small>
                            </td>
                            <td>
                                <small class="text-muted"><?php echo e($proyek->updated_at ? $proyek->updated_at->format('d/m/Y') : '-'); ?></small>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="<?php echo e(route('proyeks.edit', $proyek->id)); ?>" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('proyeks.destroy', $proyek->id)); ?>" method="POST" style="display: inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Tidak ada proyek ditemukan</h5>
                                <p class="text-muted">Silakan tambahkan proyek baru untuk memulai.</p>
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
                    Menampilkan <?php echo e($proyeks->firstItem() ?? 0); ?> sampai <?php echo e($proyeks->lastItem() ?? 0); ?> dari <?php echo e($proyeks->total()); ?> proyek
                </div>
                <div>
                    <?php echo e($proyeks->appends(request()->except('page'))->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\monitoring-proyek\resources\views/proyeks/index.blade.php ENDPATH**/ ?>