<?php $__env->startSection('content'); ?>
<div class="container-fluid py-5">
    <!-- Hero Section -->
    <div class="row mb-5">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold text-primary mb-3">
                <i class="bi bi-kanban"></i> Monitoring Proyek
            </h1>
            <p class="lead text-muted mb-4">Kelola proyek dan tugas Anda dengan efisien</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-briefcase-fill text-primary" style="font-size: 2.5rem;"></i>
                    </div>
                    <h3 class="card-title text-primary fw-bold"><?php echo e($totalProyek); ?></h3>
                    <p class="card-text text-muted">Total Proyek</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-list-task text-success" style="font-size: 2.5rem;"></i>
                    </div>
                    <h3 class="card-title text-success fw-bold"><?php echo e($tugasAktif); ?></h3>
                    <p class="card-text text-muted">Tugas Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-check-circle-fill text-info" style="font-size: 2.5rem;"></i>
                    </div>
                    <h3 class="card-title text-info fw-bold"><?php echo e($tugasSelesai); ?></h3>
                    <p class="card-text text-muted">Tugas Selesai</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="h4 mb-4 text-center">Aksi Cepat</h2>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="<?php echo e(route('proyeks.create')); ?>" class="text-decoration-none">
                        <div class="card border-0 shadow-sm h-100 hover-card">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-plus-circle-fill text-primary mb-3" style="font-size: 2rem;"></i>
                                <h5 class="card-title text-primary">Buat Proyek</h5>
                                <p class="card-text text-muted small">Mulai proyek baru</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="<?php echo e(route('tugas.create')); ?>" class="text-decoration-none">
                        <div class="card border-0 shadow-sm h-100 hover-card">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-clipboard-plus-fill text-success mb-3" style="font-size: 2rem;"></i>
                                <h5 class="card-title text-success">Buat Tugas</h5>
                                <p class="card-text text-muted small">Tambahkan tugas baru</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="<?php echo e(route('proyeks.index')); ?>" class="text-decoration-none">
                        <div class="card border-0 shadow-sm h-100 hover-card">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-list-ul text-info mb-3" style="font-size: 2rem;"></i>
                                <h5 class="card-title text-info">Daftar Proyek</h5>
                                <p class="card-text text-muted small">Lihat semua proyek</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-3 mb-3">
                    <a href="<?php echo e(route('tugas.index')); ?>" class="text-decoration-none">
                        <div class="card border-0 shadow-sm h-100 hover-card">
                            <div class="card-body text-center py-4">
                                <i class="bi bi-card-list text-warning mb-3" style="font-size: 2rem;"></i>
                                <h5 class="card-title text-warning">Daftar Tugas</h5>
                                <p class="card-text text-muted small">Kelola semua tugas</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-12">
            <h2 class="h4 mb-4 text-center">Aktivitas Terbaru</h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <!-- Recent Projects -->
                    <?php if($recentProyeks->count() > 0): ?>
                        <h5 class="mb-3 text-primary">Proyek Terbaru</h5>
                        <?php $__currentLoopData = $recentProyeks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proyek): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-briefcase-fill text-primary"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1"><strong>Proyek baru:</strong> <?php echo e($proyek->nama_proyek); ?></p>
                                    <small class="text-muted"><?php echo e($proyek->created_at->diffForHumans()); ?></small>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <!-- Recent Tasks -->
                    <?php if($recentTugas->count() > 0): ?>
                        <h5 class="mb-3 text-success mt-4">Tugas Terbaru</h5>
                        <?php $__currentLoopData = $recentTugas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tugas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex align-items-center mb-3">
                                <div class="flex-shrink-0">
                                    <i class="bi bi-list-task text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1"><strong>Tugas baru:</strong> <?php echo e($tugas->nama_tugas); ?></p>
                                    <small class="text-muted"><?php echo e($tugas->created_at->diffForHumans()); ?></small>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <?php if($recentProyeks->count() == 0 && $recentTugas->count() == 0): ?>
                        <div class="text-center text-muted">
                            <i class="bi bi-inbox fs-3"></i>
                            <p class="mt-2">Belum ada aktivitas terbaru</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<style>
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
    }
    
    .card {
        border-radius: 15px;
    }
    
    .display-4 {
        font-weight: 700;
    }
    
    .btn {
        border-radius: 10px;
        font-weight: 500;
    }
    
    @media (max-width: 768px) {
        .display-4 {
            font-size: 2.5rem;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\monitoring-proyek\resources\views/home.blade.php ENDPATH**/ ?>