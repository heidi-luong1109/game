<?php $__env->startSection('page-title', trans('app.edit_return')); ?>
<?php $__env->startSection('page-heading', $return->min_pay . ' ' . $return->max_pay); ?>

<?php $__env->startSection('content'); ?>

  <section class="content-header">
    <?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </section>

  <section class="content">
    <div class="box box-default">
      <?php echo Form::open(['route' => array('backend.returns.update', $return->id), 'files' => true, 'id' => 'return-form']); ?>

      <div class="box-header with-border">
        <h3 class="box-title"><?php echo app('translator')->get('app.edit_return'); ?></h3>
      </div>

      <div class="box-body">
        <div class="row">
          <?php echo $__env->make('backend.returns.partials.base', ['edit' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
      </div>

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">
          <?php echo app('translator')->get('app.edit_return'); ?>
        </button>

      </div>
      <?php echo Form::close(); ?>

    </div>
  </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/backend/returns/edit.blade.php ENDPATH**/ ?>