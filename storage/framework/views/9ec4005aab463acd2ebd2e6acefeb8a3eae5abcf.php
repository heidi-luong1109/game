<tr>
	<td><?php echo e($jackpot->id); ?></td>
	<td><a href="<?php echo e(route('backend.jpgame.edit', $jackpot->id)); ?>"><?php echo e($jackpot->name); ?></a></td>
	<td><?php echo e($jackpot->balance); ?></td> 
	<td><?php echo e($jackpot->start_balance); ?></td>
	<td><?php echo e($jackpot->pay_sum); ?></td>
	<td><?php echo e($jackpot->percent); ?></td>
	<td>
		<?php if(!$jackpot->view): ?>
			<small><i class="fa fa-circle text-red"></i></small>
		<?php else: ?>
			<small><i class="fa fa-circle text-green"></i></small>
		<?php endif; ?>
	</td>
	<td>
		<?php if( Auth::user()->hasRole('distributor') ): ?>
		<a class="addPayment" href="#" data-toggle="modal" data-target="#openAddModal" data-id="<?php echo e($jackpot->id); ?>" >
		<button type="button" class="btn btn-block btn-success btn-xs"><?php echo app('translator')->get('app.add'); ?></button>
		</a>
		<?php else: ?>
			<button type="button" class="btn btn-block btn-success disabled btn-xs"><?php echo app('translator')->get('app.add'); ?></button>
		<?php endif; ?>
	</td>
	<td>
		<?php if( Auth::user()->hasRole('distributor') ): ?>
		<a class="outPayment" href="#" data-toggle="modal" data-target="#openOutModal" data-id="<?php echo e($jackpot->id); ?>" >
		<button type="button" class="btn btn-block btn-danger btn-xs"><?php echo app('translator')->get('app.out'); ?></button>
		</a>
		<?php else: ?>
			<button type="button" class="btn btn-block btn-danger disabled btn-xs"><?php echo app('translator')->get('app.out'); ?></button>
		<?php endif; ?>
	</td>
</tr><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/backend/jpg/partials/row.blade.php ENDPATH**/ ?>