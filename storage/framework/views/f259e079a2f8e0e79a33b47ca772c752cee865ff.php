<?php $__env->startSection('title', 'Meus Cursos'); ?>

<?php $__env->startSection('content'); ?>

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Cursos</h1>   
</div>
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
        <?php if(count($courses) > 0): ?>
        <a href="/course/createCourse"><i class="bi bi-plus-circle-fill">Novo Curso</i></a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Curso</th>
                    <th scope="col">Alunos</th>
                    <th scope="col">Duração</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                       
                        <td><a href="/course/<?php echo e($course->id); ?>" target="_blank"><i class="bi bi-eye-fill"></i>&nbsp;<?php echo e($course->title); ?></a></td>
                        <td><?php echo e(count($course->users)); ?></td>
                        <td><?php echo e($course->duration); ?></td>
                        <td>
                            <a href="/course/editCourse/<?php echo e($course->id); ?>" class="btn btn-info edit-btn"><i class="bi bi-pencil-square"></i></a> 
                            <form action="/course/<?php echo e($course->id); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <?php if( count($course->users) == 0 ): ?>
                                <a href="#" class="btn btn-danger delete-btn"  data-toggle="modal"  data-target="#exampleModalCenter" data-id="<?php echo e($course->id); ?>"><i class="bi bi-trash"></i></a>
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
                                            <p>Tem certeza excluir o curso ?</p>
                                            <input type="hidden" id="eventId" name="eventId" value="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                                <button type="submit"  class="btn btn-primary">Excluir Curso</button>
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
        <?php
        if(auth()->user()->phone != null){ ?>
        <p>Você ainda não tem eventos, <a href="/course/createCourse">criar evento</a></p>
        <?php
        }
        else { ?>
        <p>Você ainda não pode criar cursos com o seu perfil atual.
        <?php
        }
        ?>
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
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\TCC\jcevents\resources\views/course/show.blade.php ENDPATH**/ ?>