<?php $__env->startSection('title', 'Criar Evento'); ?>

<?php $__env->startSection('content'); ?>

<?php if(auth()->user()->user_profile_id == 1): ?>
  <script>alert("Voce não tem permissão para acessar esta página");window.location.href = "/";</script>
<?php else: ?>
  <div id="event-create-container" class="col-md-6 offset-md-3">
    <div class="shadow-lg p-3 mb-5 bg-white rounded">
      <div class="shadow-none p-3 mb-5 bg-light rounded"><h1>Crie o seu evento</h1></div>
      <form action="/event" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="form-group">
          <label for="image">Imagem do Evento:(preferencia: 1200x400)</label>
          <input type="file" id="image" name="image" class="from-control-file" onchange="previewImagem()">
          <img id="preview" src="/img/events/no_image.png" style="width: 400px; height: 300px;">
        </div>
        <div class="form-group">
          <label for="title">Categoria do evento:</label><tag class="font-red">*</tag>
          <select name="eventTypeId" id="eventTypeId" class="form-control" required>
              <option value="">--Escolha uma opção--</option>
            <?php $__currentLoopData = $eventCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $eventCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($eventCategory->id); ?>"><?php echo e($eventCategory->description); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
        <div class="form-group">
          <label for="title">Evento<tag class="font-red">*</tag></label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" required>
        </div>
        <div class="form-group">
          <label for="date">Data do evento<tag class="font-red">*</tag></label>
          <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="form-group">
          <label for="time">hora de início<tag class="font-red">*</tag></label>
          <input type="time" class="form-group col-md-2" id="horaInicio" name="horaInicio" required>
        </div>
        <div class="form-group">
          <label for="time">horario do fim<tag class="font-red">*</tag></label>
          <input type="time" class="form-group col-md-2" id="horaFim" name="horaFim" required>
        </div>
      
        <div class="mapa">
          
        <input type="hidden" id="endereco" name="endereco" value="" >

        <input type="hidden" id="latitude" name="latitude" value="" >

        <input type="hidden" id="longitude" name="longitude" value="" >

        <iframe src="/searchmap/" id="iframe" name="iframe" allowfullscreen></iframe>
        
        </div>

        <div class="form-group">
          <label for="title">O evento é gratuito?</label><tag class="font-red">*</tag>
          <select name="private" id="private" class="form-control" required>
            <option value="1">Sim</option>
            <option value="0">Não</option>
          </select>
        </div>
        <div class="form-group">
          <label for="title">Video do Evento: (Cole no campo abaixo o link completo do youtube)</label>
          <input type="text" class="form-control" id="linkYoutube" name="linkYoutube" placeholder="Video do evento">
        </div>
        <div class="form-group">
          <label for="title">Sobre o evento:</label>
          <textarea name="description" id="description" rows="10" class="form-control" placeholder="O que vai acontecer no evento?"></textarea>
        </div>
        <div class="form-group">

          <label for="title">Adicione itens de infraestrutura:</label>
          <?php if($items_events): ?>
            <?php $__currentLoopData = $items_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-group">	
              <input type="checkbox" name="items[]" id="items[]" value="<?php echo e($item->id); ?>"> <?php echo e($item->description); ?>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        </div>
        <input type="submit" onClick="recuperarLocalizacao()" class="btn btn-primary" value="Criar Evento">
        <a href="/dashboard" id="btn_cancelar" class="btn btn-outline-warning">Cancelar</a>
      </form>
    </div>
  </div>
<?php endif; ?>

<script>
			function previewImagem(){
				var imagem = document.querySelector('input[name=image]').files[0];
				var preview = document.querySelector('#preview');
				
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
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\TCC\jcevents\resources\views/events/createEvent.blade.php ENDPATH**/ ?>