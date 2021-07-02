<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.title'); ?></label>
        <input type="text" class="form-control" name="title" placeholder="<?php echo app('translator')->get('app.title'); ?>" required value="<?php echo e($edit ? $category->title : ''); ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.position'); ?></label>
        <input type="text" class="form-control" name="position" placeholder="<?php echo app('translator')->get('app.position'); ?>" required value="<?php echo e($edit ? $category->position : ''); ?>">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.parent'); ?></label>
        <?php echo Form::select('parent', $categories, $edit?$category->parent:0, ['id' => 'parent', 'class' => 'form-control input-solid']); ?>

    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label><?php echo app('translator')->get('app.href'); ?></label>
        <input type="text" class="form-control" name="href" placeholder="<?php echo app('translator')->get('app.href'); ?>" required value="<?php echo e($edit ? $category->href : ''); ?>">
    </div>
</div><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/backend/categories/partials/base.blade.php ENDPATH**/ ?>