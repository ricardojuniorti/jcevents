@extends('layouts.main')

@section('title', 'Eventos que participo')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Eventos que estou participando</h1>
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
        @if(count($eventsasparticipant) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Participantes</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eventsasparticipant as $event)
                    <tr>
                        <td scropt="row">{{ $loop->index + 1 }}</td>
                        <td><a href="/event/{{ $event->id }}" target="_blank">{{ $event->title }}</a></td>
                        <td>{{ count($event->users) }}</td>
                        <td>
                            <form action="/event/leaveEvent/{{ $event->id }}" method="POST">
                                @csrf
                                @method("DELETE")
                        
                                <a href="#" class="btn btn-danger delete-btn"  data-toggle="modal" data-target="#exampleModalCenter" data-id="{{ $event->id }}"><ion-icon name="trash-outline"></ion-icon>Sair do Evento</a>

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
                                            <p>Tem certeza que deseja sair do evento ?</p>
                                            <input type="hidden" id="eventId" name="eventId" value="">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                            <button type="submit"  class="btn btn-primary">Sair do Evento</button>
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
        <p>Você ainda não está participando de nenhum evento, <a href="/">veja todos os eventos</a></p>
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