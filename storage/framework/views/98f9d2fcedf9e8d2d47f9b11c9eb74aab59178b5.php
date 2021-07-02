<tr>        
    <td><a href="<?php echo e(route('backend.returns.edit', $return->id)); ?>"><?php echo e($return->min_pay); ?></a></td>
	<td><a href="<?php echo e(route('backend.returns.edit', $return->id)); ?>"><?php echo e($return->max_pay); ?></a></td> 
	<td><a href="<?php echo e(route('backend.returns.edit', $return->id)); ?>"><?php echo e($return->percent); ?></a></td>
	<td><?php echo e($return->min_balance); ?></td>
	<td>
		<?php if(!$return->status): ?>
			<small><i class="fa fa-circle text-red"></i></small>
		<?php else: ?>
			<small><i class="fa fa-circle text-green"></i></small>
		<?php endif; ?>
	</td>
</tr><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/backend/returns/partials/row.blade.php ENDPATH**/ ?>