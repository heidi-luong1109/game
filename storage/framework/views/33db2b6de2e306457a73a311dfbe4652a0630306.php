<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.name'); ?></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="<?php echo app('translator')->get('app.name'); ?>" required value="<?php echo e($edit ? $jackpot->name : ''); ?>">
    </div>
</div>
<?php if( Auth::user()->hasRole('distributor') ): ?>
    <div class="col-md-6">
        <div class="form-group">
            <label><?php echo app('translator')->get('app.balance'); ?></label>
            <input type="text" class="form-control" id="balance" name="balance" placeholder="0.00" disabled value="<?php echo e($edit ? $jackpot->balance : ''); ?>">
        </div>
    </div>
<?php endif; ?>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.start_balance'); ?></label>
        <input type="text" class="form-control" id="start_balance" name="start_balance" placeholder="0.00" value="<?php echo e($edit ? $jackpot->start_balance : ''); ?>">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.trigger'); ?></label>
        <input type="text" class="form-control" id="pay_sum" name="pay_sum" placeholder="<?php echo app('translator')->get('app.pay_sum'); ?>" required value="<?php echo e($edit ? $jackpot->pay_sum : ''); ?>">
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.percent'); ?></label>
        <?php
            $percents = array_combine(\VanguardLTE\JPG::$values['percent'], \VanguardLTE\JPG::$values['percent']);
        ?>
        <?php echo Form::select('percent', $percents, $edit ? $jackpot->percent : '', ['class' => 'form-control']); ?>

    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.status'); ?></label>
        <?php echo Form::select('view', ['0' => 'Disabled', '1' => 'Active'], $jackpot->view, ['id' => 'view', 'class' => 'form-control']); ?>

    </div>
</div><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/backend/jpg/partials/base.blade.php ENDPATH**/ ?>