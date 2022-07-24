@extends('layouts.main')

@section('title', $classe->title)

@section('content')

<div class="col-md-10 offset-md-1">
  <div class="shadow-lg p-3 mb-5 bg-white rounded">
    <div class="row">
      <div id="image-container" class="col-md-6">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{$linkVideoFormatado}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <div class="col-md-10" id="description-container">
          <form action="/classe/createMessage/{{$classe->id}}" method="POST">
            @csrf
            <h3>Deixe seu comentário:</h3>
            <textarea name="message" id="message" rows="3" class="form-control" placeholder="deixe o comentario" required></textarea><br>
            <input type="submit" class="btn btn-primary" value="Enviar">
          </form><br>
          @if(isset($messageClasses))
            @if($messageClasses <> null)
              <div class="col-md-12" id="message-container">
                <h4><b>Comentários</b></h4>
                @foreach($messageClasses as $messageClasse)
                
                  <p><b>{{$messageClasse->name}} - {{ date('d/m/y H:i:s',  strtotime($messageClasse->data_envio))   }}</b></p>
                  <p>{{$messageClasse->message}}</p>
                  <hr>
                @endforeach
              </div>
            @else
              <p>Nenhum comentário</p>
            @endif
          @endif
        </div>   
      </div>
      <div id="info-container" class="col-md-6">
        <h1>{{ $classe->title }}</h1>  <br>
      
        <input type="checkbox" id="scales" name="scales">
        <label for="scales">Marcar como lido</label>
      
        @if(session('msg'))
        <div class="alert alert-success" role="alerta" id="msgItem">{{ session('msg') }}</div>
          <script>
                setTimeout(function() {
                  $('#msgItem').fadeOut('slow');
                }, 4000);
          </script>
        @endif     
        </div>
      </div>
    </div>
  </div>

</div>

@endsection