<?php $__env->startSection('title', 'Cursos que participo'); ?>

<?php $__env->startSection('content'); ?>

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Cursos que estou matriculado</h1>
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
        <?php if(count($coursesasparticipant) > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Alunos</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $coursesasparticipant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td scropt="row"><a href="/course/<?php echo e($course->id); ?>" target="_blank"><i class="bi bi-eye-fill"></i></a></td>
                        <td><a href="/course/<?php echo e($course->id); ?>" target="_blank"><?php echo e($course->title); ?></a></td>
                        <td><?php echo e(count($course->users)); ?></td>
                        <td>
                            <form action="/course/leaveCourse/<?php echo e($course->id); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field("DELETE"); ?>
                        
                                <a href="#" class="btn btn-danger delete-btn"  data-toggle="modal" data-target="#exampleModalCenter" data-id="<?php echo e($course->id); ?>"><ion-icon name="trash-outline"></ion-icon>Sair do Curso</a>

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
                                            <p>Tem certeza que deseja abandonar o curso ?</p>
                                            <input type="hidden" id="eventId" name="eventId" value="">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                            <button type="submit"  class="btn btn-primary">Sair do Curso</button>
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
        <p>Você ainda não está participando de nenhum curso, <a href="/courses">ver todos </a></p>
        <?php endif; ?>
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
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\TCC\jcevents\resources\views/course/myCourses.blade.php ENDPATH**/ ?>