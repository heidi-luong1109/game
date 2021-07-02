<?php $__env->startSection('page-title', trans('app.games')); ?>
<?php $__env->startSection('page-heading', trans('app.games')); ?>

<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>

    <section class="content">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo app('translator')->get('app.game_update'); ?></h3>
            </div>
        <div class="box-body">
          <div class="row">

                <form action="<?php echo e(route('backend.game.categories')); ?>" method="POST" class="pb-2 mb-3 border-bottom-light" id="massForm">

                        <div class="col-md-12">
                                <div class="form-group">						
                            <label for="change_category"><?php echo app('translator')->get('app.add_or_change'); ?></label>
                            <select name="action" class="form-control" id="massAction">
                                <option value="change_values">---</option>
                                <option value="add_category"><?php echo app('translator')->get('app.add_in_categories'); ?></option>
                                <option value="change_category"><?php echo app('translator')->get('app.change_categories'); ?></option>
                                <?php if (\Auth::user()->hasPermission('games.delete')) : ?>
								<option value="delete_games"><?php echo app('translator')->get('app.delete_games'); ?></option>
                                <option value="stay_games"><?php echo app('translator')->get('app.stay_games'); ?></option>
                                <?php endif; ?>
                            </select>
                            </div>
                        </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="device"><?php echo app('translator')->get('app.categories'); ?></label>
                            <select name="category[]" id="category" class="form-control select2" multiple="multiple" style="width: 100%;" >
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" ><?php echo e($category->title); ?></option>
                                    <?php $__currentLoopData = $category->inner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($inner->id); ?>"><?php echo e($inner->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="games"><?php echo app('translator')->get('app.games_list'); ?></label>
                                <textarea id="games" name="games" class="form-control" rows="5"></textarea>
                            </div>
                        </div>

            </div>

          <div class="row">


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="rezerv"><?php echo app('translator')->get('app.doubling'); ?></label>
                                <?php echo Form::select('rezerv', $emptyGame->get_values('rezerv', true), '', ['class' => 'form-control']); ?>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="view"><?php echo app('translator')->get('app.view'); ?></label>
                                <select name="view" id="view" class="form-control">
                                    <option value="">---</option>
                                    <option value="1"><?php echo app('translator')->get('app.active'); ?></option>
                                    <option value="0"><?php echo app('translator')->get('app.disabled'); ?></option>
                                </select>
                            </div>
                        </div>					

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bet"><?php echo app('translator')->get('app.bet'); ?></label>
                                <?php echo Form::select('bet', $emptyGame->get_values('bet', true), '', ['class' => 'form-control']); ?>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="scaleMode"><?php echo app('translator')->get('app.scaling'); ?></label>
                                <select name="scaleMode" id="scaleMode" class="form-control" >
                                    <option value="">---</option>
                                    <option value="showAll"><?php echo app('translator')->get('app.default'); ?></option>
                                    <option value="exactFit"><?php echo app('translator')->get('app.full_screen'); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="slotViewState"><?php echo app('translator')->get('app.ui'); ?></label>
                                <select name="slotViewState" id="slotViewState" class="form-control" >
                                    <option value="">---</option>
                                    <option value="Normal"><?php echo app('translator')->get('app.visible_ui'); ?></option>
                                    <option value="HideUI"><?php echo app('translator')->get('app.hide_ui'); ?></option>
                                </select>
                            </div>
                        </div>

              <div class="col-md-4">
                  <div class="form-group">
                      <label for="title"><?php echo app('translator')->get('app.gamebank'); ?></label>
                      <?php echo Form::select('gamebank', ['' => '---'] + $emptyGame->gamebankNames, '', ['class' => 'form-control']); ?>

                  </div>
              </div>
						
            </div>
<ul class="list-group list-group-unbordered">
    <li class="list-group-item">

<div class="row">
						
                        <?php $__currentLoopData = [1,3,5,7,9,10]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="<?php if( !auth()->user()->shop_id ): ?> col-md-4 <?php else: ?> col-md-6 <?php endif; ?>">
                                <div class="form-group">
                                    <label for="garant_win<?php echo e($index); ?>"><?php echo app('translator')->get('app.spin'); ?> - L <?php echo e($index); ?><?php echo e($index >= 10 ? '+' : ''); ?></label>
                                    <?php echo Form::select('garant_win' . $index, $emptyGame->get_values('garant_win' . $index, true), '', ['class' => 'form-control']); ?>

                                </div>
                            </div>

                            <div class="<?php if( !auth()->user()->shop_id ): ?> col-md-4 <?php else: ?> col-md-6 <?php endif; ?>">
                                <div class="form-group">
                                    <label for="winline<?php echo e($index); ?>"><?php echo app('translator')->get('app.trigger'); ?> - L <?php echo e($index); ?><?php echo e($index >= 10 ? '+' : ''); ?></label>
                                    <?php echo Form::select('winline' . $index, $emptyGame->get_values('winline' . $index, true), '', ['class' => 'form-control']); ?>

                                </div>
                            </div>
        <?php if( !auth()->user()->shop_id ): ?>
        <div class="col-md-4">
            <div class="form-group">
                <label for="winline<?php echo e($index); ?>"><?php echo app('translator')->get('app.volatility'); ?> - L <?php echo e($index); ?><?php echo e($index >= 10 ? '+' : ''); ?></label>
                <?php echo Form::select('match_winline' . $index, $emptyGame->get_values('match_winline' . $index, true), '', ['class' => 'form-control']); ?>

            </div>
        </div>
        <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

    </li>
</ul>

<div class="row">

                        <?php $__currentLoopData = [1,3,5,7,9,10]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="<?php if( !auth()->user()->shop_id ): ?> col-md-4 <?php else: ?> col-md-6 <?php endif; ?>">
                                <div class="form-group">
                                    <label for="garant_bonus<?php echo e($index); ?>"><?php echo app('translator')->get('app.spin_bonus'); ?> - L <?php echo e($index); ?><?php echo e($index >= 10 ? '+' : ''); ?></label>
                                    <?php echo Form::select('garant_bonus' . $index, $emptyGame->get_values('garant_bonus' . $index, true), '', ['class' => 'form-control']); ?>

                                </div>
                            </div>

                            <div class="<?php if( !auth()->user()->shop_id ): ?> col-md-4 <?php else: ?> col-md-6 <?php endif; ?>">
                                <div class="form-group">
                                    <label for="winbonus<?php echo e($index); ?>"><?php echo app('translator')->get('app.trigger_bonus'); ?> - L <?php echo e($index); ?><?php echo e($index >= 10 ? '+' : ''); ?></label>
                                    <?php echo Form::select('winbonus' . $index, $emptyGame->get_values('winbonus' . $index, true), '', ['class' => 'form-control']); ?>

                                </div>
                            </div>

        <?php if( !auth()->user()->shop_id ): ?>
        <div class="col-md-4">
            <div class="form-group">
                <label for="match_winbonus<?php echo e($index); ?>"><?php echo app('translator')->get('app.volatility_bonus'); ?> - L <?php echo e($index); ?><?php echo e($index >= 10 ? '+' : ''); ?></label>
                <?php echo Form::select('match_winbonus' . $index, $emptyGame->get_values('match_winbonus' . $index, true), '', ['class' => 'form-control']); ?>

            </div>
        </div>
        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<div class="row">
                        <div class="col-md-12">
                            <input type="hidden" value="<?= csrf_token() ?>" name="_token">
                            <input type="hidden" value="<?php echo e(implode(',', $ids)); ?>" name="ids">
                            <button type="submit" class="btn btn-primary">
                                <?php echo app('translator')->get('app.update'); ?>
                            </button>

                            <?php if (\Auth::user()->hasPermission('games.delete')) : ?>
                            <button type="button" class="btn btn-danger" id="massDelete">
                                <?php echo app('translator')->get('app.delete'); ?>
                            </button>
                            <?php endif; ?>


                            <?php if (\Auth::user()->hasPermission('games.delete')) : ?>
                            <button type="button" class="btn btn-danger" id="massStay">
                                <?php echo app('translator')->get('app.stay_games'); ?>
                            </button>
                            <?php endif; ?>

                        </div>
</div>
                </form>
          </div>
        </div>

    </section>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $('#massDelete').click(function(){
            $('#massAction option[value="delete_games"]').prop('selected', true);

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: "<?php echo app('translator')->get('app.please_confirm'); ?>",
                html: "<?php echo app('translator')->get('app.are_you_sure_delete_game'); ?>",
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                focusCancel: false,
                reverseButtons: true,
                position: 'top-start',
                confirmButtonText: "<?php echo app('translator')->get('app.yes_delete_him'); ?>",
            }).then(function (t) {
                $('form#massForm').submit();
            });

        });


        $('#massStay').click(function(){
            $('#massAction option[value="stay_games"]').prop('selected', true);

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: "<?php echo app('translator')->get('app.please_confirm'); ?>",
                html: "<?php echo app('translator')->get('app.are_you_sure_delete_game'); ?>",
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                focusCancel: false,
                reverseButtons: true,
                position: 'top-start',
                confirmButtonText: "<?php echo app('translator')->get('app.yes_i_do'); ?>",
            }).then(function (t) {
                $('form#massForm').submit();
            });

        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/backend/games/mass.blade.php ENDPATH**/ ?>