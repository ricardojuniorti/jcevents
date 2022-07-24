<?php $__env->startSection('title', 'Dasboard'); ?>

<?php $__env->startSection('content'); ?>

<?php if(auth()->user()->user_profile_id == 1): ?>
    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="col-md-10 offset-md-1 dashboard-title-container">
        <h1>Meus Eventos</h1>   
    </div>
<?php endif; ?>

<div class="col-md-10 offset-md-1 dashboard-events-container">
    <?php if(session('msg')): ?>
        <div class="alert alert-success" role="alerta" id="msgItem"><?php echo e(session('msg')); ?></div>
        <script>
                setTimeout(function() {
                $('#msgItem').fadeOut('fast');
                }, 4000);
        </script>
    <?php endif; ?>
    <div class="shadow-lg p-3 mb-5 bg-white rounded">
        <?php if(count($events) > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"><a href="/event/createEvent"><i class="bi bi-plus-circle-fill">Novo Evento</i></a></th>
                    <th scope="col">Nome</th>
                    <th scope="col">Participantes</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td scropt="row"><?php echo e($loop->index + 1); ?></td>
                        <td><a href="/event/<?php echo e($event->id); ?>" target="_blank"><?php echo e($event->title); ?></a></td>
                        <td><?php echo e(count($event->users)); ?></td>
                        <td>
                            <a href="/event/editEvent/<?php echo e($event->id); ?>" class="btn btn-info edit-btn"><i class="bi bi-pencil-square"></i></a> 
                            <form action="/event/<?php echo e($event->id); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <?php if( count($event->users) == 0 ): ?>
                                <a href="#" class="btn btn-danger delete-btn"  data-toggle="modal"  data-target="#exampleModalCenter" data-id="<?php echo e($event->id); ?>"><i class="bi bi-trash"></i></a>
                                <?php else: ?>
                                <a href="#" class="btn btn-outline-warning" placeholder="Não pode excluir quando tem participante"><i class="bi bi-x-octagon"></i></a>
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
                                            <p>Tem certeza excluir o evento ?</p>
                                            <input type="hidden" id="eventId" name="eventId" value="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                                <button type="submit"  class="btn btn-primary">Excluir Evento</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
            </tbody>
        </table>
        <?php else: ?>
            <?php if(auth()->user()->user_profile_id == 1): ?>
                <script>window.location.href = "/event/myEvent";</script>
            <?php else: ?>
                <p>Ainda não existe nenhum evento criado com o seu usuário</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<script>

$('#exampleModalCenter').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var recipientId = button.data('id');

    var modal = $(this);
    modal.find('#eventId').val(recipientId);
})


</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\TCC\jcevents\resources\views/events/dashboard.blade.php ENDPATH**/ ?>