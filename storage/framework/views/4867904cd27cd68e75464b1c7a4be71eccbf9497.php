
<div class="row">

    <div class="col-md-4">
        <div class="form-group">
            <label for="title"><?php echo app('translator')->get('app.gamebank'); ?></label>
            <?php echo Form::select('gamebank', $game->gamebankNames, $edit ? $game->gamebank : '', ['class' => 'form-control', 'required' => true]); ?>

        </div>
    </div>

    <div class="col-md-4">
        <?php if(!$edit || $game->rezerv !== ''): ?>
            <div class="form-group">
                <label for="rezerv"><?php echo app('translator')->get('app.doubling'); ?></label>
                <?php echo Form::select('rezerv', $game->get_values('rezerv'), $edit ? $game->rezerv : '', ['class' => 'form-control', 'required' => true]); ?>

            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-4">
        <?php if(!$edit || $game->cask !== ''): ?>
            <div class="form-group">
                <label for="cask"><?php echo app('translator')->get('app.health'); ?></label>
                <?php echo Form::select('cask', $game->get_values('cask'), $edit ? $game->cask : '', ['class' => 'form-control', 'required' => true]); ?>

            </div>
        <?php endif; ?>
    </div>


</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="title"><?php echo app('translator')->get('app.jpg'); ?></label>
            <?php echo Form::select('jpg_id', ['' => '---'] + $jpgs, $edit ? $game->jpg_id : '', ['class' => 'form-control']); ?>

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="title"><?php echo app('translator')->get('app.labels'); ?></label>
            <?php echo Form::select('label', ['' => '---'] + $game->labels, $edit ? $game->label : '', ['class' => 'form-control']); ?>

        </div>
    </div>
</div>

<ul class="list-group list-group-unbordered">
    <li class="list-group-item">

        <div class="row">

            <?php $__currentLoopData = [1,3,5,7,9,10]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php $key = 'garant_win' . $index; ?>
                <?php if(!$edit || $game->$key !== ''): ?>
                    <div class="<?php if( !$game->shop_id ): ?> col-md-4 <?php else: ?> col-md-6 <?php endif; ?>">
                        <div class="form-group">
                            <label for="<?php echo e($key); ?>"><?php echo app('translator')->get('app.spin'); ?> - L <?php echo e($index); ?><?php echo e($index >= 10 ? '+' : ''); ?></label>
                            <?php echo Form::select($key, $game->get_values($key, false, $edit ? $game->$key: false), $edit ? $game->$key : '', ['class' => 'form-control', 'required' => true]); ?>

                        </div>
                    </div>
                <?php endif; ?>

                <?php $key = 'winline' . $index; ?>
                <?php if(!$edit || $game->$key !== ''): ?>
                    <div class="<?php if( !$game->shop_id ): ?> col-md-4 <?php else: ?> col-md-6 <?php endif; ?>">
                        <div class="form-group">
                            <label for="<?php echo e($key); ?>"><?php echo app('translator')->get('app.trigger'); ?> - L <?php echo e($index); ?><?php echo e($index >= 10 ? '+' : ''); ?></label>
                            <?php echo Form::select($key, $game->get_values($key, false, $edit ? $game->$key: false), $edit ? $game->$key : '', ['class' => 'form-control', 'required' => true]); ?>

                        </div>
                    </div>
                <?php endif; ?>

                <?php if( !$game->shop_id ): ?>
                    <?php $key = 'winline' . $index; ?>
                    <?php if(!$edit || $game->game_win->$key !== ''): ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="<?php echo e($key); ?>"><?php echo app('translator')->get('app.volatility'); ?> - L <?php echo e($index); ?><?php echo e($index >= 10 ? '+' : ''); ?></label>
                                <?php echo Form::select('match_' . $key, $game->get_values('match_' . $key, false, $edit ? $game->game_win->$key: false), $edit ? $game->game_win->$key : '', ['class' => 'form-control', 'required' => true]); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </li>
</ul>




<div class="row">

    <?php if($edit): ?>
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-primary" id="update-details-btn">
                <?php echo app('translator')->get('app.edit_game'); ?>
            </button>
        </div>
    <?php endif; ?>
</div><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/backend/games/partials/match.blade.php ENDPATH**/ ?>