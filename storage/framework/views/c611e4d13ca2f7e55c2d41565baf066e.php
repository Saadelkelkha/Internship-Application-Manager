<?php if (isset($component)) { $__componentOriginal9522ac5a798eecfc31fc76fba1faa696 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9522ac5a798eecfc31fc76fba1faa696 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.masterpage','data' => ['title' => 'Home']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('masterpage'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Home']); ?>
   
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9522ac5a798eecfc31fc76fba1faa696)): ?>
<?php $attributes = $__attributesOriginal9522ac5a798eecfc31fc76fba1faa696; ?>
<?php unset($__attributesOriginal9522ac5a798eecfc31fc76fba1faa696); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9522ac5a798eecfc31fc76fba1faa696)): ?>
<?php $component = $__componentOriginal9522ac5a798eecfc31fc76fba1faa696; ?>
<?php unset($__componentOriginal9522ac5a798eecfc31fc76fba1faa696); ?>
<?php endif; ?><?php /**PATH C:\Users\lekou\OneDrive\Desktop\Stage\Stage\resources\views/etudiant/home.blade.php ENDPATH**/ ?>