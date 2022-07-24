<?php if($errors->any()): ?>
    <div <?php echo e($attributes); ?>>
        <div class="font-medium text-red-600"><?php echo e(__('Oops! Algo deu errado.')); ?></div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<?php /**PATH E:\laragon\www\TCC\jcevents\vendor\laravel\jetstream\src/../resources/views/components/validation-errors.blade.php ENDPATH**/ ?>