@extends('layouts.main')

@section('title', $course->title)

@section('content')

<div class="col-md-10 offset-md-1">
  <div class="shadow-lg p-3 mb-5 bg-white rounded">
    <div class="row">
      <div id="image-container" class="col-md-6">
        <img src="/img/events/{{ $course->image }}" class="img-fluid" alt="{{ $course->title }}">
      </div>
      <div id="info-container" class="col-md-6">
        <h1>{{ $course->title }}</h1>  <br>
       
        @if(session('msg'))
          <div class="alert alert-success" role="alerta" id="msgItem">{{ session('msg') }}</div>
            <script>
                  setTimeout(function() {
                    $('#msgItem').fadeOut('slow');
                  }, 4000);
            </script>
        @endif
            
        @if(isset(auth()->user()->id))
          @if($course->user_id == auth()->user()->id)
            <a href="#"><i class="bi bi-plus-circle-fill" data-toggle="modal" data-target="#exampleModalCenter">Cadastrar Aula</i></a><br><br>
          @endif
        @endif
        <table class="table">
        <?php $contaLinha = 0;?>
        @foreach($classes as $classe)
          <?php $contaLinha++; ?>
          <tr>
            <td>
            @if(!$hasUserJoined)    
              <i class="bi bi-caret-right-square-fill">&nbsp;<?php echo $contaLinha;?>  - {{$classe->title}}</i><br>
            @else
              <i class="bi bi-caret-right-square-fill">&nbsp;<a href="/classe/detailsClasse/{{$classe->id}}" target="_blank">&nbsp;<?php echo $contaLinha;?> - {{$classe->title}}</a></i><br>
            @endif
            </td>
            @if(isset(auth()->user()->id))
              @if($course->user_id == auth()->user()->id)
                <td>
                  <a href="/classe/editClasse/{{ $classe->id }}" data-toggle="modal" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="blue" class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                  </a>
                </td>
                <td>
                  <form action="/classe/{{ $classe->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a href="#" data-toggle="modal"  data-target="#modalConfirmExclusao" data-id="{{ $classe->id }}">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                      </svg>
                    </a>
                      <input type="hidden" name="courseId" name="courseId" value="{{$course->id}}">

                      <!-- Modal de confirmação de exclusão-->
                      <div class="modal fade" id="modalConfirmExclusao" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Confirmação</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <p>Tem certeza que deseja excluir esta aula?</p>
                            <input type="hidden" id="classeId" name="classeId" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                <button type="submit"  class="btn btn-danger">Excluir aula</button>
                            </div>
                            </div>
                        </div>
                      </div>
                  </form>  
                </td>
              @endif
            @endif
          </tr>
        @endforeach
        </table>
        @if(!$hasUserJoined)
          <form action="/course/joinCourse/{{ $course->id }}" method="POST">
            @csrf
            <a href="/course/joinEvent/{{ $course->id }}" 
              class="btn btn-primary" 
              id="event-submit"
              onclick="event.preventDefault();
              this.closest('form').submit();">
              Inscrever-se
            </a>
          </form>
        @else
          <p class="already-joined-msg">Status: matriculado</p>
        @endif
      </div>
      <div class="col-md-12" id="description-container">
        <h3>Detalhes sobre o curso:</h3>
        <p class="event-description">{{ $course->description }}</p>
      </div>
      
    </div>
  </div>
</div>

<!-- Modal  Cadastrar Aula-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cadastrar Aula</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/classe" method="POST">
        @csrf
        <div class="modal-body">
          <input type="hidden" id="courses_id" name="courses_id" value="{{$course->id}}">
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
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>

$('#modalConfirmExclusao').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var recipientId = button.data('id');

    var modal = $(this);
    modal.find('#classeId').val(recipientId);
})


$('#editAula').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var recipientId = button.data('id');

    var modal = $(this);
    modal.find('#classe_id').val(recipientId);
})

</script>

@endsection