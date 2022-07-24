

<?php $__env->startSection('title', 'Editando: ' . $course->title); ?>

<?php $__env->startSection('content'); ?>

<div id="event-create-container" class="col-md-6 offset-md-3">
  <div class="shadow-lg p-3 mb-5 bg-white rounded">
    <div class="alert alert-success messageBox" id="alerta" role="alert"></div>

    <?php if(session('msg')): ?>
    <div class="alert alert-success" role="alerta" id="msgItem"><?php echo e(session('msg')); ?></div>
      <script>
            setTimeout(function() {
              $('#msgItem').fadeOut('slow');
            }, 4000);
      </script>
    <?php endif; ?>
    <?php if(isset($msg)): ?>
    <div class="alert alert-success" role="alerta" id="msgItem"><?php echo e($msg); ?></div>
    <script>
          $('html,body').animate({scrollTop: 9999});
          setTimeout(function() {
            $('#msgItem').fadeOut('slow');
          }, 4000);
    </script>
    <?php endif; ?>
      <form action="/course/updateCourse/<?php echo e($course->id); ?>" method="POST" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>
      <div class="shadow-none p-3 mb-5 bg-light rounded"><h1>Editando: <?php echo e($course->title); ?></h1></div>  
        <div class="form-group">
          <label for="image">Imagem do Curso:</label>
          <input type="file" id="image" name="image" class="from-control-file" onchange="previewImagem()" required>
          <img src="/img/events/<?php echo e($course->image); ?>" alt="<?php echo e($course->title); ?>" class="img-preview">
        </div>
        <button class="btn btn-success" id="alteraImagem">Alterar Imagem</button>
      </form><BR><BR>
      <form  name="formEdit" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>
      
      <div class="form-group">
        <label for="title">Curso:</label><tag class="font-red">*</tag>
        <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" value="<?php echo e($course->title); ?>" required>
      </div>
     
      <div class="form-group">
        <label for="title">Sobre o curso:</label>
        <textarea name="description" id="description" rows="10" class="form-control" placeholder="O que vai acontecer no curso" required><?php echo e($course->description); ?></textarea>
      </div>

      <div class="form-group">
        <label for="title">Ativo?</label><tag class="font-red">*</tag>
        <select name="active" id="active" class="form-control" required>
          <option value="0">Não</option>
          <option value="1"<?php echo e($course->active == 1 ? "selected='selected'" : ""); ?>>Sim</option>
        </select>
      </div>

      <div class="form-group">
        <label for="title">Duração:</label><tag class="font-red">*</tag>
        <input type="text" class="form-control" id="duration" name="duration" placeholder="duracao" value="<?php echo e($course->duration); ?>" required>
      </div>

      <BR>
      <input type="submit" id="buttonSubmit"  class="btn btn-primary" value="Atualizar">
      <a href="/course/show" id="btn_cancelar" class="btn btn-outline-warning">Cancelar</a>
    </form>
  </div>
</div>
<script>
  $(function(){

      $('form[name="formEdit"]').submit(function(event){

        event.preventDefault();
        //console.log(response);

      $.ajax({
        url: "/course/updateCourse/<?php echo e($course->id); ?>",
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response){
          //$('html,body').scrollTop(0);
          $('html, body').animate({scrollTop:0},500);      
          var container = document.querySelector('#alerta');
          container.style.display = 'block';
          $('.messageBox').html('Dados atualizados com sucesso!');
          setTimeout(function() {
            $('#alerta').fadeOut('slow');
          }, 4000);
          //console.log(response);
        } 
      });

    });
    
  });
    
   $('#itemEvent').chosen( {allow_single_deselect: true} );

  $('#exampleModalCenter').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var recipientId = button.data('id');

      var modal = $(this);
      modal.find('#itemId').val(recipientId);
  });

  function previewImagem(){
				var imagem = document.querySelector('input[name=image]').files[0];
				var preview = document.querySelector('.img-preview');
				
				var reader = new FileReader();
				
				reader.onloadend = function () {
					preview.src = reader.result;
				}
				
				if(imagem){
					reader.readAsDataURL(imagem);
				}else{
					preview.src = "";
				}
  }

</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\TCC\jcevents\resources\views/course/editCourse.blade.php ENDPATH**/ ?>