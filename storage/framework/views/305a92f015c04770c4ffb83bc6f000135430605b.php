<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.multiplier'); ?></label>
        <?php
            $multipliers = array_combine(\VanguardLTE\HappyHour::$values['multiplier'], \VanguardLTE\HappyHour::$values['multiplier']);
        ?>
        <?php echo Form::select('multiplier', $multipliers, $edit ? $happyhour->multiplier : '', ['class' => 'form-control']); ?>

    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.wager'); ?></label>
        <?php
            $wagers = array_combine(\VanguardLTE\HappyHour::$values['wager'], \VanguardLTE\HappyHour::$values['wager']);
        ?>
        <?php echo Form::select('wager', $wagers, $edit ? $happyhour->wager : '', ['class' => 'form-control']); ?>

    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.time'); ?></label>
        <?php
            $times = array_combine(\VanguardLTE\HappyHour::$values['time'], \VanguardLTE\HappyHour::$values['time']);
        ?>
        <?php echo Form::select('time', \VanguardLTE\HappyHour::$values['time'], $edit ? $happyhour->time : '', ['class' => 'form-control']); ?>

    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.status'); ?></label>
        <?php echo Form::select('status', ['0' => __('app.disabled'), '1' => __('app.active')], $edit ? $happyhour->status : 1, ['id' => 'status', 'class' => 'form-control']); ?>

    </div>
</div><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/backend/happyhours/partials/base.blade.php ENDPATH**/ ?>