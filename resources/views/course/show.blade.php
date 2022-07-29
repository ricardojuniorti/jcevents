@extends('layouts.main')

@section('title', 'Meus Cursos')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Cursos</h1>   
</div>
<div class="col-md-10 offset-md-1 dashboard-events-container">
    @if(session('msg'))
        <div class="alert alert-success" role="alerta" id="msgItem">{{ session('msg') }}</div>
        <script>
                setTimeout(function() {
                $('#msgItem').fadeOut('fast');
                }, 4000);
        </script>
    @endif
    <div class="shadow-lg p-3 mb-5 bg-white rounded">
        @if(count($courses) > 0)
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
                @foreach($courses as $course)
                    <tr>
                       
                        <td><a href="/course/{{ $course->id }}" target="_blank"><i class="bi bi-eye-fill"></i>&nbsp;{{ $course->title }}</a></td>
                        <td>{{ count($course->users) }}</td>
                        <td>{{ $course->duration }}</td>
                        <td>
                            <a href="/course/editCourse/{{ $course->id }}" class="btn btn-info edit-btn"><i class="bi bi-pencil-square"></i></a> 
                            <form action="/course/{{ $course->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                @if ( count($course->users) == 0 )
                                <a href="#" class="btn btn-danger delete-btn"  data-toggle="modal"  data-target="#exampleModalCenter" data-id="{{ $course->id }}"><i class="bi bi-trash"></i></a>
                                @else
                                <a href="#" class="btn btn-outline-warning" placeholder="Não pode excluir quando tem participante"><i class="bi bi-x-octagon"></i></a>
                                @endif
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
                @endforeach    
            </tbody>
        </table>
        @else
        <?php
        if(auth()->user()->id != 1){ ?>
        <p>Você ainda não cadastrou nenhum curso!  <a href="/course/createCourse">Criar curso</a></p>
        <?php
        }
        else { ?>
        <p>Você ainda não pode criar cursos com o seu perfil atual.
        <?php
        }
        ?>
        @endif
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

@endsection