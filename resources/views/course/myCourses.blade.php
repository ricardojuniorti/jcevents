@extends('layouts.main')

@section('title', 'Cursos que participo')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Cursos que estou matriculado</h1>
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
        @if(count($coursesasparticipant) > 0)
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
                @foreach($coursesasparticipant as $course)
                    <tr>
                        <td scropt="row"><a href="/course/{{ $course->id }}" target="_blank"><i class="bi bi-eye-fill"></i></a></td>
                        <td><a href="/course/{{ $course->id }}" target="_blank">{{ $course->title }}</a></td>
                        <td>{{ count($course->users) }}</td>
                        <td>
                            <form action="/course/leaveCourse/{{ $course->id }}" method="POST">
                                @csrf
                                @method("DELETE")
                        
                                <a href="#" class="btn btn-danger delete-btn"  data-toggle="modal" data-target="#exampleModalCenter" data-id="{{ $course->id }}"><ion-icon name="trash-outline"></ion-icon>Sair do Curso</a>

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
                @endforeach    
            </tbody>
        </table>
        @else
        <p>Você ainda não está participando de nenhum curso, <a href="/courses">ver todos </a></p>
        @endif
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