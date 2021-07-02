<?php $__env->startSection('page-title', trans('app.edit_game')); ?>
<?php $__env->startSection('page-heading', $game->name); ?>

<?php $__env->startSection('content'); ?>

    <section class="content-header">
        <?php echo $__env->make('backend.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-3">

                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <center>
                            <img class="img-responsive" src="<?php echo e($edit ? '/frontend/Default/ico/' . $game->name . '.jpg' : ''); ?>" alt="<?php echo e($edit ? $game->name : ''); ?>">
                        </center>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><?php echo app('translator')->get('app.percent'); ?></b> <a class="pull-right"><?php echo e($game->shop?$game->shop->percent:'0'); ?></a>
                            </li>
                            <?php if (\Auth::user()->hasPermission('games.in_out')) : ?>
                            <li class="list-group-item">
                                <b><?php echo app('translator')->get('app.in'); ?></b> <a class="pull-right"><?php echo e($game->stat_in); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo app('translator')->get('app.out'); ?></b> <a class="pull-right"><?php echo e($game->stat_out); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo app('translator')->get('app.total'); ?></b>
                                <a class="pull-right">
                                    <?php if(($game->stat_in - $game->stat_out) >= 0): ?>
                                        <span class="text-green">
		<?php else: ?>
                                                <span class="text-red">
		<?php endif; ?>
                                                    <?php echo e(number_format(abs($game->stat_in-$game->stat_out), 4, '.', '')); ?>

		</span>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo app('translator')->get('app.rtp'); ?></b> <a class="pull-right"><?php echo e($game->stat_in > 0 ? number_format(($game->stat_out / $game->stat_in) * 100, 2, '.', '') : '0.00'); ?></a>
                            </li>
                            <?php endif; ?>
                        </ul>

                        <?php if (\Auth::user()->hasPermission('games.delete')) : ?>
                        <a href="<?php echo e(route('backend.game.delete', $game->id)); ?>" class="btn btn-danger btn-block"
                           data-method="DELETE"
                           data-confirm-title="<?php echo app('translator')->get('app.please_confirm'); ?>"
                           data-confirm-text="<?php echo app('translator')->get('app.are_you_sure_delete_game'); ?>"
                           data-confirm-delete="<?php echo app('translator')->get('app.yes_delete_him'); ?>">
                            <b>DELETE</b></a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="box box-primary">
                    <div class="box-body">
                        <h4><?php echo app('translator')->get('app.latest_stats'); ?></h4>

                        <table class="table table-borderless table-striped">
                            <thead>
                            <tr>
                                <th><?php echo app('translator')->get('app.user'); ?></th>
                                <th><?php echo app('translator')->get('app.win'); ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if(count($game_stat)): ?>
                                <?php $__currentLoopData = $game_stat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <a href="<?php echo e(route('backend.game_stat', ['user' => $stat->user->username])); ?>">
                                                <?php echo e($stat->user->username); ?>

                                            </a>
                                        </td>
                                        <td><?php echo e($stat->win); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr><td colspan="2"><?php echo app('translator')->get('app.no_data'); ?></td></tr>
                            <?php endif; ?>

                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

            <div class="col-md-9" id="colrighttemp">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a id="details-tab"
                               data-toggle="tab"
                               href="#details">
                                <?php echo app('translator')->get('app.game_details'); ?>
                            </a>
                        </li>
                        <?php if( !($game->winline === '' && $game->winbonus === '' && $game->gamebank === '' &&
                            $game->garant_win === '' && $game->garant_bonus === '' &&
                            $game->game_win->winline === '' && $game->game_win->winbonus === '' ) ): ?>
                            <li>
                                <a id="authentication-tab"
                                   data-toggle="tab"
                                   href="#login-details">
                                    <?php echo app('translator')->get('app.game_settings'); ?>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if( !($game->winline === '' && $game->winbonus === '' && $game->gamebank === '' &&
                            $game->garant_win === '' && $game->garant_bonus === '' &&
                            $game->game_win->winline === '' && $game->game_win->winbonus === '' ) ): ?>
                            <li>
                                <a id="bonus-tab"
                                   data-toggle="tab"
                                   href="#bonus-details">
                                    <?php echo app('translator')->get('app.game_bonuses'); ?>
                                </a>
                            </li>
                        <?php endif; ?>

                    </ul>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="active tab-pane" id="details">
                            <?php echo Form::open(['route' => ['backend.game.update', $game->id], 'method' => 'POST', 'id' => 'details-form']); ?>

                            <?php echo $__env->make('backend.games.partials.base', ['profile' => false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo Form::close(); ?>

                        </div>


                        <div class="tab-pane" id="login-details">
                            <?php echo Form::open(['route' => ['backend.game.update', $game->id], 'method' => 'POST', 'id' => 'login-details-form']); ?>

                            <?php echo $__env->make('backend.games.partials.match', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo Form::close(); ?>

                        </div>

                        <div class="tab-pane" id="bonus-details">
                            <?php echo Form::open(['route' => ['backend.game.update', $game->id], 'method' => 'POST', 'id' => 'bonus-details-form']); ?>

                            <?php echo $__env->make('backend.games.partials.bonus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo Form::close(); ?>

                        </div>

                    </div>

                </div>

                <script src="/back/js/Chart.min.js"></script>

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo app('translator')->get('app.line_chart'); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="canvas"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </section>





    <?php

        $date_start = date("Y-m-d H:i:s", strtotime('-60 days', time()));
        $date_end = date("Y-m-d H:i:s");
        $labels = [];
        $wins = [];
        $bets = [];

        for($i=1; $i<=60; $i++){
            $label = date("Y-m-d", strtotime(-60 + $i . ' days', time()));
            $labels[] = $label;
            $wins[$label] = 0;
            $bets[$label] = 0;
        }

        foreach($game->statistics AS $stat){
            $label = date("Y-m-d", strtotime($stat->date_time));
            if( isset($wins[$label]) ){
                $wins[$label] += $stat->win;
            }
            if( isset($bets[$label]) ){
                $bets[$label] += $stat->bet;
            }
        }

//echo '<pre>';
    //print_r($labels);
    //echo '</pre>';

    ?>

    <script>

        window.chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };

        Chart.scaleService.updateScaleDefaults('linear', {
            ticks: {
                min: 0
            }
        });

        var color = Chart.helpers.color;
        var config = {
            type: 'line',
            data: {
                labels: ["<?php echo implode('","', $labels); ?>"],
                datasets: [{
                    label: 'Win',
                    backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                    borderColor: window.chartColors.blue,
                    fill: false,
                    data: [<?php $__currentLoopData = $wins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $win): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($win); ?>, <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                }, {
                    label: 'Bet',
                    backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                    borderColor: window.chartColors.red,
                    fill: false,
                    data: [<?php $__currentLoopData = $bets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($bet); ?>, <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: false,
                    text: '<?php echo app('translator')->get('app.line_chart'); ?>'
                },
                scales: {
                    xAxes: [{
                        type: 'category',
                        display: false,
                        scaleLabel: {
                            display: false,
                            labelString: '<?php echo app('translator')->get('app.date'); ?>'
                        },
                        ticks: {
                            major: {
                                fontStyle: 'bold',
                                fontColor: '#FF0000'
                            }
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: '<?php echo app('translator')->get('app.sum_bet'); ?>'
                        }
                    }]
                }
            }
        };

        window.onload = function() {
            var ctx = document.getElementById('canvas').getContext('2d');
            window.myLine = new Chart(ctx, config);
        };



    </script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $('.changeAddSum').click(function(event){
            $('#AddSum').val($(event.target).data('value'));
            $('#gamebank_add').submit();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/backend/games/edit.blade.php ENDPATH**/ ?>