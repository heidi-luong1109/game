<tr>
	<td><?php echo e($happyhour->id); ?></td>
	<td><a href="<?php echo e(route('backend.happyhour.edit', $happyhour->id)); ?>"><?php echo e($happyhour->multiplier); ?></a></td>
	<td><?php echo e($happyhour->wager); ?></td>
	<td><?php echo e(\VanguardLTE\HappyHour::$values['time'][$happyhour->time]); ?></td>
	<td>
		<?php if(!$happyhour->status): ?>
			<small><i class="fa fa-circle text-red"></i></small>
		<?php else: ?>
			<small><i class="fa fa-circle text-green"></i></small>
		<?php endif; ?>
	</td>

</tr><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/backend/happyhours/partials/row.blade.php ENDPATH**/ ?>