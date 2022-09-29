

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
                  <form action="/classe/deleteMessage/<?php echo e($messageClasse->classe_id); ?>" method="POST">  
                    <input type="hidden" name="classeId" id="classeId" value="<?php echo e($messageClasse->classe_id); ?>">          
                    <p><b><?php echo e($messageClasse->name); ?> - <?php echo e(date('d-m-y H:i', strtotime($messageClasse->data_envio) )); ?> 
                    <?php echo csrf_field(); ?> 
                    <?php echo method_field('DELETE'); ?>
                    <?php if(auth()->user()->id === $messageClasse->user_id): ?>
                      <a href="#" class=""  data-toggle="modal"  data-target="#exampleModalCenter" data-id="<?php echo e($messageClasse->id); ?>">
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                      </svg>
                      </a>
                    <?php endif; ?>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Confirmação</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <p>Tem certeza excluir esta mensagem ?</p>
                                <input type="hidden" id="messageId" name="messageId" value="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                    <button type="submit"  class="btn btn-primary">Excluir mensagem</button>
                                </div>
                            </div>
                        </div>
                    </div>
                  </form></b></p>
                  <p><?php echo e($messageClasse->message); ?></p>
                  
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
        <form name="formEdit" enctype="multipart/form-data">
          <?php $lido = 0;?>
          <?php $__currentLoopData = $aulasLidas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aulaLida): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($aulaLida->users_id == auth()->user()->id && $aulaLida->classes_id == $classe->id): ?>
            <?php $lido = 1;?>
              <?php if($aulaLida->reading == 1): ?>
                <p class="already-joined-msg" id="msgRead">Status: Assistido</p>
                <input type="submit" id="buttonSubmit" name="buttonSubmit"  class="btn btn-primary" value="Marcar como não assistido">
                <input type="hidden" id="users_id" name="users_id" value="<?php echo e(auth()->user()->id); ?>">      
                <input type="hidden" id="classes_id" name="classes_id" value="<?php echo e($classe->id); ?>">
                <input type="hidden" id="reading" name="reading" value="0">
              <?php else: ?>
                <p class="already-joined-msg" id="msgRead">Status: Não assistido</p>
                <input type="submit" id="buttonSubmit" name="buttonSubmit"  class="btn btn-primary" value="Marcar como assistido">
                <input type="hidden" id="users_id" name="users_id" value="<?php echo e(auth()->user()->id); ?>">      
                <input type="hidden" id="classes_id" name="classes_id" value="<?php echo e($classe->id); ?>">
                <input type="hidden" id="reading" name="reading" value="1">
              <?php endif; ?>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php if($lido == 0){?>
          <p class="already-joined-msg" id="msgRead">Status: Não assistido</p>
          <input type="submit" id="buttonSubmit" name="buttonSubmit"  class="btn btn-primary" value="Marcar como assistido">
          <input type="hidden" id="users_id" name="users_id" value="<?php echo e(auth()->user()->id); ?>">      
          <input type="hidden" id="classes_id" name="classes_id" value="<?php echo e($classe->id); ?>">
          <input type="hidden" id="reading" name="reading" value="1">
          <?php }?>
          <?php echo csrf_field(); ?> 
          <?php echo method_field('POST'); ?>    
        </form>
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

<script>

$('#buttonSubmit').click(function(){		
  // o texto do botão é alterado e o atributo title
  if($('#buttonSubmit').val() == "Marcar como assistido"){
    $('#buttonSubmit').val("Marcar como não assistido")
    $('#msgRead').text("Status: Assitido")
    $('#reading').val("1")
  }
  else{
    $('#buttonSubmit').val("Marcar como assistido")
    $('#msgRead').text("Status: Não Assitido")
    $('#reading').val("0")
  }

});

$('#exampleModalCenter').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var recipientId = button.data('id');

    var modal = $(this);
    modal.find('#messageId').val(recipientId);
})


$(function(){

  $('form[name="formEdit"]').submit(function(user){

    user.preventDefault();
    
    $.ajax({
      url: "/classe/updateRead/<?php echo e($classe->id); ?>",
      type: "POST",
      data: $(this).serialize(),
      dataType: 'json',
      success: function(response){      
        console.log($('#reading').val());
      } 
    });

  });

});

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\TCC\jcevents\resources\views/classe/detailsClasse.blade.php ENDPATH**/ ?>