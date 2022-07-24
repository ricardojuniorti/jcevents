@extends('layouts.main')

@section('title', 'Editando: ' . $event->title)

@section('content')

@if(auth()->user()->user_profile_id == 1)
  <script>alert("Voce não tem permissão para acessar esta página");window.location.href = "/";</script>
@else
  <div id="event-create-container" class="col-md-6 offset-md-3">
    <div class="shadow-lg p-3 mb-5 bg-white rounded">
      <div class="alert alert-success messageBox" id="alerta" role="alert"></div>

      @if(session('msg'))
      <div class="alert alert-success" role="alerta" id="msgItem">{{ session('msg') }}</div>
        <script>
              setTimeout(function() {
                $('#msgItem').fadeOut('slow');
              }, 4000);
        </script>
      @endif
      @if(isset($msg))
      <div class="alert alert-success" role="alerta" id="msgItem">{{ $msg }}</div>
      <script>
            $('html,body').animate({scrollTop: 9999});
            setTimeout(function() {
              $('#msgItem').fadeOut('slow');
            }, 4000);
      </script>
      @endif
        <form action="/event/updateEvent/{{$event->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="shadow-none p-3 mb-5 bg-light rounded"><h1>Editando: {{ $event->title }}</h1></div>  
          <div class="form-group">
            <label for="image">Imagem do Evento:</label>
            <input type="file" id="image" name="image" class="from-control-file" required>
            <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-preview">
          </div>
          <button class="btn btn-success" id="alteraImagem">Alterar Imagem</button>
        </form><BR><BR>
        <form  name="formEdit" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="title">Categoria do evento:</label><tag class="font-red">*</tag>
          <select name="eventTypeId" id="eventTypeId" class="form-control" required>
              <option value="">--Escolha uma opção--</option>
              @foreach($eventCategories as $eventCategory)
                @if($eventCategory->active == 1)
                  <option value="{{$eventCategory->id}}"{{ $event->event_type_id == $eventCategory->id ? "selected='selected'" : "" }}>{{$eventCategory->description}}</option>
                @endif
          @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="title">Evento:</label><tag class="font-red">*</tag>
          <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" value="{{ $event->title }}" required>
        </div>
        <div class="form-group">
          <label for="date">Data do evento:</label><tag class="font-red">*</tag>
          <input type="date" class="form-control" id="date" name="date" value="{{ $event->date->format('Y-m-d') }}" required>
        </div>
        <div class="form-group">
          <label for="time">hora de início:</label><tag class="font-red">*</tag>
          <input type="time" class="form-group col-md-2" id="horaInicio" name="horaInicio" value="{{ $event->hora_inicio }}" required>
        </div>
        <div class="form-group">
          <label for="time">horario do fim:</label><tag class="font-red">*</tag>
          <input type="time" class="form-group col-md-2" id="horaFim" name="horaFim" value="{{ $event->hora_fim }}" required>
        </div>
        <div class="form-group">
          <p><b>Endereço atual:</b></p>
          <p id="enderecoAtual">{{ $event->address }}</p><tag class="font-red">*</tag>
          <label for="title"> (Para alterar, informe no campo abaixo a nova localização)</label>
        </div>
        <div class="mapa">
          
        <input type="hidden" id="endereco" name="endereco" value="{{ $event->address }}">

        <input type="hidden" id="latitude" name="latitude" value="">

        <input type="hidden" id="longitude" name="longitude" value="">

        <iframe src="/searchmap/" id="iframe" name="iframe" allowfullscreen></iframe>
        
        </div>
        <div class="form-group">
          <label for="title">O evento é gratuito?</label><tag class="font-red">*</tag>
          <select name="private" id="private" class="form-control" required>
            <option value='0'>Não</option>
            <option value='1' {{ $event->private == 1 ? "selected='selected'" : "" }}>Sim</option>
          </select>
        </div>
        <div class="form-group">
          <label for="title">Video do evento:</label>
          <input type="text" class="form-control" id="linkYoutube" name="linkYoutube" placeholder="Link video do evento" value="{{ $event->linkYoutube }}">
        </div>
        <div class="form-group">
          <label for="title">Sobre o evento:</label>
          <textarea name="description" id="description" rows="10" class="form-control" placeholder="O que vai acontecer no evento?" required>{{ $event->description }}</textarea>
        </div>
        <BR>
        <input type="submit" id="buttonSubmit"  class="btn btn-primary" value="Editar Evento" onClick="recuperarLocalizacao()">
        <button id="btn_cancelar"  class="btn btn-outline-warning" onclick="event.preventDefault();">Cancelar</button>
      </form>
      <BR><BR>
      <form action="/event/editItemEvent/{{$event->id}}" method="POST" enctype="multipart/form-data">
        @csrf 
        <div class="form-group">
          <select name="itemEvent" id="itemEvent" class="itemEvent col-md-4">
            @foreach($items_events as $itemEvent)
            <option value="{{$itemEvent->id}}">{{ $itemEvent->description }}</option>
            @endforeach
          </select>
          <button class="btn btn-success" id="formEdit">Incluir item no evento</button>
        </div>
      </form>
      @if(count($items_selecionados) == 0)
        <p>Nenhum item adicionado!</p>
      @else
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"><i class="ion-ios-compose-outline"></i></th>
            <th scope="col">Itens extras deste evento</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
            @foreach($items_selecionados as $item)
              <tr>
                  <td><i class="ion-ios-arrow-forward"></i></td>
                  <td>{{ $item->description }}</td>
                  <td>
                    <form action="/event/itemEvent/{{ $item->id }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" id="eventId" name="eventId" value="{{ $event->id }}">
                      
                      <a href="#" class="btn btn-danger delete-btn"  data-toggle="modal"  data-target="#exampleModalCenter" data-id="{{ $item->id }}"><i class="bi bi-trash"></i></a>

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
                            <p>Tem certeza que deseja excluir este item ?</p>
                            <input type="hidden" id="itemId" name="itemId" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                <button type="submit"  class="btn btn-primary">Excluir</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </form>
                  </td>
              </tr>
            @endforeach
          @endif 
        </tbody>
      </table>
    </div>
  </div>
@endif
<script>
  $(function(){

      $('form[name="formEdit"]').submit(function(event){

        event.preventDefault();
        //console.log(response);

      $.ajax({
        url: "/event/updateEvent/{{$event->id}}",
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response){
          //$('html,body').scrollTop(0);
          $('html, body').animate({scrollTop:0},500);      
          var container = document.querySelector('#alerta');
          container.style.display = 'block';
          $('.messageBox').html('Dados atualizados com sucesso!');
          setTimeout(function() {
            $('#alerta').fadeOut('slow');
          }, 4000);
          //console.log(response);
        } 
      });

    });
    
  });
    
   $('#itemEvent').chosen( {allow_single_deselect: true} );

  $('#exampleModalCenter').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var recipientId = button.data('id');

      var modal = $(this);
      modal.find('#itemId').val(recipientId);
  });

</script>


@endsection