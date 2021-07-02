<tr>        
    <td><a href="<?php echo e(route('backend.pincode.edit', $pincode->id)); ?>"><?php echo e($pincode->code?:$pincode->id); ?></a></td>
	<td><?php echo e($pincode->nominal); ?></td>
	<td><?php echo e($pincode->created_at); ?></td>
    <td>
        <?php if( $pincode->status ): ?>
            <small><i class="fa fa-circle text-green"></i></small>
        <?php else: ?>
            <small><i class="fa fa-circle text-red"></i></small>
        <?php endif; ?>
    </td>
</tr><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/backend/pincodes/partials/row.blade.php ENDPATH**/ ?>