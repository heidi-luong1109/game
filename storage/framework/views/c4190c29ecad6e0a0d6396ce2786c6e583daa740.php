<tr>
    <td>
		<?php if (\Auth::user()->hasPermission('games.edit')) : ?>
		<a href="<?php echo e(route('backend.game.edit', $game->id)); ?>">
		<?php endif; ?>

		<?php echo e($game->title); ?>


		<?php if (\Auth::user()->hasPermission('games.edit')) : ?>
		</a>
		<?php endif; ?>
	</td>
	<?php if (\Auth::user()->hasPermission('games.in_out')) : ?>
	<td><?php echo e($game->stat_in); ?></td>
	<td><?php echo e($game->stat_out); ?></td>
	<td>
		<?php if(($game->stat_in - $game->stat_out) >= 0): ?>
			<span class="text-green">
		<?php else: ?>
			<span class="text-red">
		<?php endif; ?>	
		<?php echo e(number_format(abs($game->stat_in-$game->stat_out), 2, '.', '')); ?>

		</span>
	</td>
	<?php endif; ?>
	<td><?php echo e($game->bids); ?></td>
	<td><?php echo e($game->denomination); ?></td>
<td>

	<label class="checkbox-container">
		<input type="checkbox" name="checkbox[<?php echo e($game->id); ?>]">
		<span class="checkmark"></span>
	</label>
			<!--
        <input class="custom-control-input minimal" id="cb-[<?php echo e($game->id); ?>]" name="checkbox[<?php echo e($game->id); ?>]" type="checkbox">

			-->
</td>
</tr><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/backend/games/partials/row.blade.php ENDPATH**/ ?>