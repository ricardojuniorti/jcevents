

<?php $__env->startSection('title', 'Editando a aula: ' . $classe->title); ?>

<?php $__env->startSection('content'); ?>

<div id="event-create-container" class="col-md-6 offset-md-3">
  <div class="shadow-lg p-3 mb-5 bg-white rounded">
    <div class="alert alert-success messageBox" id="alerta" role="alert"></div>

    <?php if(session('msg')): ?>
    <div class="alert alert-success" role="alerta" id="msgItem"><?php echo e(session('msg')); ?></div>
      <script>
            setTimeout(function() {
              $('#msgItem').fadeOut('fast');
            }, 4000);
      </script>
    <?php endif; ?>
    <?php if(isset($msg)): ?>
    <div class="alert alert-success" role="alerta" id="msgItem"><?php echo e($msg); ?></div>
    <script>
          setTimeout(function() {
            $('#msgItem').fadeOut('fast');
          }, 4000);
    </script>
    <?php endif; ?>
      
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>
      <div class="shadow-none p-3 mb-5 bg-light rounded"><h1>Editando: <?php echo e($classe->title); ?></h1></div>  
      <form  name="formEdit" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>
      <div class="form-group">
        <label for="title">Titulo:</label><tag class="font-red">*</tag>
        <input type="text" class="form-control" id="title" name="title" placeholder="Perfil" value="<?php echo e($classe->title); ?>" required>
      </div>
      <div class="form-group">
        <label for="title">Link da aula:</label><tag class="font-red">*</tag>
        <input type="text" class="form-control" id="link_video" name="link_video" placeholder="link_video" value="<?php echo e($classe->link_video); ?>" required>
      </div>
      <div class="form-group">
        <label for="title">Duração:</label><tag class="font-red">*</tag>
        <input type="text" class="form-control" id="duration" name="duration" placeholder="duration" value="<?php echo e($classe->duration); ?>" required>
      </div>
      <div class="form-group">
        <label for="title">Ativo?</label><tag class="font-red">*</tag>
        <select name="active" id="active" class="form-control" required>
          <option value="0">Não</option>
          <option value="1"<?php echo e($classe->active == 1 ? "selected='selected'" : ""); ?>>Sim</option>
        </select>
      </div>
      <BR>
      <input type="submit" id="buttonSubmit"  class="btn btn-primary" value="Atualizar">
      <a href="../../course/1" id="btn_cancelar" onclick="window.close()" class="btn btn-outline-warning">Sair</a>
    </form>
  </div>
</div>
<script>
  $(function(){

      $('form[name="formEdit"]').submit(function(user){

        user.preventDefault();
        //console.log(response);

      $.ajax({
        url: "/classe/updateClasse/<?php echo e($classe->id); ?>",
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response){
          $('html,body').scrollTop(0);      
          var container = document.querySelector('#alerta');
          container.style.display = 'block';
          $('.messageBox').html('Dados atualizados com sucesso!');
          setTimeout(function() {
            $('#alerta').fadeOut('fast');
          }, 4000);
          //console.log(document.querySelector('#active').value);
        } 
      });

    });
    
  });
    
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\TCC\jcevents\resources\views/classe/editClasse.blade.php ENDPATH**/ ?>