

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1 class="mb-4">Detail Proyek</h1>
    <div class="card shadow">
        <div class="card-body">
            <h3><?php echo e($proyek->nama_proyek); ?></h3>
            <p><?php echo e($proyek->deskripsi); ?></p>
            <p>
                <strong>Status:</strong> 
                <span class="badge bg-<?php echo e($proyek->status == 'aktif' ? 'primary' : 'success'); ?>">
                    <?php echo e(ucfirst($proyek->status)); ?>

                </span>
            </p>
            <p>
                <strong>File:</strong>
                <?php if($proyek->file_path): ?>
                    <a href="<?php echo e(asset('storage/' . $proyek->file_path)); ?>" target="_blank" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-file-download"></i> Download
                    </a>
                <?php else: ?>
                    <span class="text-muted">Tidak ada file</span>
                <?php endif; ?>
            </p>
            <p>
                <strong>Dibuat:</strong> <?php echo e($proyek->created_at->format('d/m/Y H:i')); ?><br>
                <strong>Diupdate:</strong> <?php echo e($proyek->updated_at->format('d/m/Y H:i')); ?>

            </p>
            <a href="<?php echo e(route('proyeks.index')); ?>" class="btn btn-secondary me-2">Kembali ke Daftar Proyek</a>
            <a href="<?php echo e(route('tugas.index')); ?>" class="btn btn-outline-secondary">Kembali ke Daftar Tugas</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\monitoring-proyek\resources\views/proyeks/show.blade.php ENDPATH**/ ?>