<?php $__env->startSection('title', $classe->title); ?>

<?php $__env->startSection('content'); ?>

<div class="col-md-10 offset-md-1">
  <div class="shadow-lg p-3 mb-5 bg-white rounded">
    <div class="row">
      <div id="image-container" class="col-md-6">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo e($linkVideoFormatado); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <div class="col-md-10" id="description-container">
          <form action="/classe/createMessage/<?php echo e($classe->id); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <h3>Deixe seu comentário:</h3>
            <textarea name="message" id="message" rows="3" class="form-control" placeholder="deixe o comentario" required></textarea><br>
            <input type="submit" class="btn btn-primary" value="Enviar">
          </form><br>
          <?php if(isset($messageClasses)): ?>
            <?php if($messageClasses <> null): ?>
              <div class="col-md-12" id="message-container">
                <h4><b>Comentários</b></h4>
                <?php $__currentLoopData = $messageClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $messageClasse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                  <p><b><?php echo e($messageClasse->name); ?> - <?php echo e(date('d/m/y H:i:s',  strtotime($messageClasse->data_envio))); ?></b></p>
                  <p><?php echo e($messageClasse->message); ?></p>
                  <hr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            <?php else: ?>
              <p>Nenhum comentário</p>
            <?php endif; ?>
          <?php endif; ?>
        </div>   
      </div>
      <div id="info-container" class="col-md-6">
        <h1><?php echo e($classe->title); ?></h1>  <br>
      
        <input type="checkbox" id="scales" name="scales">
        <label for="scales">Marcar como lido</label>
      
        <?php if(session('msg')): ?>
        <div class="alert alert-success" role="alerta" id="msgItem"><?php echo e(session('msg')); ?></div>
          <script>
                setTimeout(function() {
                  $('#msgItem').fadeOut('slow');
                }, 4000);
          </script>
        <?php endif; ?>     
        </div>
      </div>
    </div>
  </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\TCC\jcevents\resources\views/classe/detailsClasse.blade.php ENDPATH**/ ?>