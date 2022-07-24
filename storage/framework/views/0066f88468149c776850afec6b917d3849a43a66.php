<?php $__env->startSection('title', $course->title); ?>

<?php $__env->startSection('content'); ?>

<div class="col-md-10 offset-md-1">
  <div class="shadow-lg p-3 mb-5 bg-white rounded">
    <div class="row">
      <div id="image-container" class="col-md-6">
        <img src="/img/events/<?php echo e($course->image); ?>" class="img-fluid" alt="<?php echo e($course->title); ?>">
      </div>
      <div id="info-container" class="col-md-6">
        <h1><?php echo e($course->title); ?></h1>  <br>
       
        <?php if($course->user_id == auth()->user()->id): ?>
          <a href="/course/createClasse"><i class="bi bi-plus-circle-fill">Cadastrar Aula</i></a><br><br>
        <?php endif; ?>
        <?php if(!$hasUserJoined): ?>
          <i class="bi bi-caret-right-square-fill">&nbsp;1 Aula teste 2:30</i>
        <?php else: ?>
          <i class="bi bi-caret-right-square-fill">&nbsp;<a href="">1 Aula teste 2:30</a></i>
        <?php endif; ?>
        <?php if(!$hasUserJoined): ?>
          <form action="/course/joinCourse/<?php echo e($course->id); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <a href="/course/joinEvent/<?php echo e($course->id); ?>" 
              class="btn btn-primary" 
              id="event-submit"
              onclick="event.preventDefault();
              this.closest('form').submit();">
              Inscrever-se
            </a>
          </form>
        <?php else: ?>
          <p class="already-joined-msg">Status: matriculado</p>
        <?php endif; ?>
      </div>
      <div class="col-md-12" id="description-container">
        <h3>Detalhes sobre o curso:</h3>
        <p class="event-description"><?php echo e($course->description); ?></p>
      </div>
      
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\TCC\jcevents\resources\views/course/detailscourse.blade.php ENDPATH**/ ?>