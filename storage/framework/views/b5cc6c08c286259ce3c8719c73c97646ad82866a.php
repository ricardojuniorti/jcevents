<!-- Modal  Cadastrar Aula-->
<?php if(isset($classe)): ?> 
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Editar Aula</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php echo e($classe->id); ?>

        <form action="/classe/updateClasse" method="POST">
          <?php echo csrf_field(); ?>
          <div class="modal-body">
            <input type="hidden" id="classe_id" name="classe_id" value="">
            <label for="title">Url da aula:</label><tag class="font-red">*</tag>
            <input type="text" class="form-control" id="link_video" name="link_video" placeholder="link..." value="" required>
            <br>
            <label for="title">Titulo da aula:</label><tag class="font-red">*</tag>
            <input type="text" class="form-control" id="title" name="title" placeholder="aula..." value="" required>
            <br>
            <label for="title">Ativo?</label><tag class="font-red">*</tag>
            <select name="active" id="active" class="form-control" required>
              <option value="1">Sim</option>
              <option value="0">Não</option>   
            </select>
            <br>
            <label for="title">Duração:</label><tag class="font-red">*</tag>
            <input type="text" class="form-control" id="duration" name="duration" placeholder="padrao: horas e minutos" value="" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Atualizar</button>
          </div>
        </form>
      </div>
    </div>
<?php endif; ?>
<?php /**PATH E:\laragon\www\TCC\jcevents\resources\views////classe/editClasse.blade.php ENDPATH**/ ?>