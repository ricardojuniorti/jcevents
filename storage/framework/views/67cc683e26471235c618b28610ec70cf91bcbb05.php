

<?php $__env->startSection('title', 'Nova Aula'); ?>

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
      <div class="shadow-none p-3 mb-5 bg-light rounded"><h1>Nova aula</h1></div>  
      <form  name="formEdit" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <?php echo method_field('POST'); ?>
      <div class="form-group">
        <label for="title">Url da aula:</label><tag class="font-red">*</tag>
        <input type="text" class="form-control" id="link_video" name="link_video" placeholder="aula..." value="" required>
      </div>
      <div class="form-group">
        <label for="title">titulo da aula:</label><tag class="font-red">*</tag>
        <input type="text" class="form-control" id="title" name="title" placeholder="aula..." value="" required>
      </div>
      <div class="form-group">
        <label for="title">Ativo?</label><tag class="font-red">*</tag>
        <select name="active" id="active" class="form-control" required>
          <option value="1">Sim</option>
          <option value="0">Não</option>   
        </select>
      </div>
      <div class="form-group">
        <label for="title">ordem:(ordem em que as aulas aparecerão para os alunos)</label><tag class="font-red">*</tag>
        <input type="text" class="form-control" id="title" name="title" placeholder="aula..." value="" required>
      </div>
      <div class="form-group">
        <label for="title">Duração:</label><tag class="font-red">*</tag>
        <input type="text" class="form-control" id="duration" name="duration" placeholder="aula..." value="" required>
      </div>
      <BR>
      <input type="submit" id="buttonSubmit"  class="btn btn-primary" value="Salvar">
      <a href="/userProfile/show" id="btn_cancelar" class="btn btn-outline-warning">Voltar</a>
    </form>
  </div>
</div>
<script>
  $(function(){

      $('form[name="formEdit"]').submit(function(user){

        user.preventDefault();
        //console.log(response);

      $.ajax({
        url: "/userProfile",
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response){
          $('html,body').scrollTop(0);      
          var container = document.querySelector('#alerta');
          container.style.display = 'block';
          $('.messageBox').html('Perfil criado com sucesso!');
          $('#description').val("");
          $('#active').val("");
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
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\TCC\jcevents\resources\views/classe/createClasse.blade.php ENDPATH**/ ?>