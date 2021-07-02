<ul class="list-group list-group-unbordered">
    <li class="list-group-item">
        <div class="row">
            <?php $__currentLoopData = [1,3,5,7,9,10]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php $key = 'garant_bonus' . $index; ?>
                <?php if(!$edit || $game->$key !== ''): ?>
                    <div class="<?php if( !$game->shop_id ): ?> col-md-4 <?php else: ?> col-md-6 <?php endif; ?>">
                        <div class="form-group">
                            <label for="<?php echo e($key); ?>"><?php echo app('translator')->get('app.spin_bonus'); ?> - L <?php echo e($index); ?><?php echo e($index >= 10 ? '+' : ''); ?></label>
                            <?php echo Form::select($key, $game->get_values($key, false, $edit ? $game->$key: false), $edit ? $game->$key : '', ['class' => 'form-control', 'required' => true]); ?>

                        </div>
                    </div>
                <?php endif; ?>

                <?php $key = 'winbonus' . $index; ?>
                <?php if(!$edit || $game->$key !== ''): ?>
                    <div class="<?php if( !$game->shop_id ): ?> col-md-4 <?php else: ?> col-md-6 <?php endif; ?>">
                        <div class="form-group">
                            <label for="<?php echo e($key); ?>"><?php echo app('translator')->get('app.trigger_bonus'); ?> - L <?php echo e($index); ?><?php echo e($index >= 10 ? '+' : ''); ?></label>
                            <?php echo Form::select($key, $game->get_values($key, false, $edit ? $game->$key: false), $edit ? $game->$key : '', ['class' => 'form-control', 'required' => true]); ?>

                        </div>
                    </div>
                <?php endif; ?>

                <?php if( !$game->shop_id ): ?>
                    <?php $key = 'winbonus' . $index; ?>
                    <?php if(!$edit || $game->game_win->$key !== ''): ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="<?php echo e($key); ?>"><?php echo app('translator')->get('app.volatility_bonus'); ?> - L <?php echo e($index); ?><?php echo e($index >= 10 ? '+' : ''); ?></label>
                                <?php echo Form::select('match_' . $key, $game->get_values('match_' . $key, false, $edit ? $game->game_win->$key: false), $edit ? $game->game_win->$key : '', ['class' => 'form-control', 'required' => true]); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </li>
</ul>


<ul class="list-group list-group-unbordered">
    <li class="list-group-item">
        <div class="row">
            <?php $__currentLoopData = [1,3,5,7,9,10]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                <?php $key = 'garant_win_bonus' . $index; ?>
                <?php if(!$edit || $game->$key !== ''): ?>
                    <div class="<?php if( !$game->shop_id ): ?> col-md-4 <?php else: ?> col-md-6 <?php endif; ?>">
                        <div class="form-group">
                            <label for="<?php echo e($key); ?>"><?php echo app('translator')->get('app.spin_in_bonus'); ?> - L <?php echo e($index); ?><?php echo e($index >= 10 ? '+' : ''); ?></label>
                            <?php echo Form::select($key, $game->get_values($key, false, $edit ? $game->$key: false), $edit ? $game->$key : '', ['class' => 'form-control', 'required' => true]); ?>

                        </div>
                    </div>
                <?php endif; ?>

                <?php $key = 'winline_bonus' . $index; ?>
                <?php if(!$edit || $game->$key !== ''): ?>
                    <div class="<?php if( !$game->shop_id ): ?> col-md-4 <?php else: ?> col-md-6 <?php endif; ?>">
                        <div class="form-group">
                            <label for="<?php echo e($key); ?>"><?php echo app('translator')->get('app.trigger_in_bonus'); ?> - L <?php echo e($index); ?><?php echo e($index >= 10 ? '+' : ''); ?></label>
                            <?php echo Form::select($key, $game->get_values($key, false, $edit ? $game->$key: false), $edit ? $game->$key : '', ['class' => 'form-control', 'required' => true]); ?>

                        </div>
                    </div>
                <?php endif; ?>

                <?php if( !$game->shop_id ): ?>
                    <?php $key = 'winline_bonus' . $index; ?>
                    <?php if(!$edit || $game->game_win->$key !== ''): ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="<?php echo e($key); ?>"><?php echo app('translator')->get('app.volatility_in_bonus'); ?> - L <?php echo e($index); ?><?php echo e($index >= 10 ? '+' : ''); ?></label>
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
</div><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/backend/games/partials/bonus.blade.php ENDPATH**/ ?>