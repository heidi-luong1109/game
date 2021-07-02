<?php $__env->startSection('page-title', trans('app.add_category')); ?>
<?php $__env->startSection('page-heading', trans('app.add_category')); ?>

<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>

    <section class="content">
        <div class="box box-danger">
            <?php echo Form::open(['route' => 'backend.category.store', 'files' => true, 'id' => 'user-form']); ?>

            <div class="box-header with-border">
                <h3 class="box-title"><?php echo app('translator')->get('app.add_category'); ?></h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <?php echo $__env->make('backend.categories.partials.base', ['edit' => false, 'profile' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">
                    <?php echo app('translator')->get('app.add_category'); ?>
                </button>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/backend/categories/add.blade.php ENDPATH**/ ?>