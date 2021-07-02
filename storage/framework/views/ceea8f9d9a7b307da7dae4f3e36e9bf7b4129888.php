<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.min_pay'); ?></label>
        <input type="text" class="form-control" name="min_pay" placeholder="<?php echo app('translator')->get('app.min_pay'); ?>" required value="<?php echo e($edit ? $return->min_pay : ''); ?>">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.max_pay'); ?></label>
        <input type="text" class="form-control" name="max_pay" placeholder="<?php echo app('translator')->get('app.max_pay'); ?>" required value="<?php echo e($edit ? $return->max_pay : ''); ?>">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.percent'); ?></label>
        <?php
            $percents = array_combine(\VanguardLTE\Returns::$values['percent'], \VanguardLTE\Returns::$values['percent']);
        ?>
        <?php echo Form::select('percent', $percents, $edit ? $return->percent : '', ['class' => 'form-control']); ?>

    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.min_balance'); ?></label>
        <input type="text" class="form-control" name="min_balance" placeholder="<?php echo app('translator')->get('app.min_balance'); ?>" required value="<?php echo e($edit ? $return->min_balance : 0); ?>">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.status'); ?></label>
        <?php echo Form::select('status', ['0' => __('app.disabled'), '1' => __('app.active')], $edit ? $return->status : 1, ['id' => 'status', 'class' => 'form-control']); ?>

    </div>
</div><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/backend/returns/partials/base.blade.php ENDPATH**/ ?>