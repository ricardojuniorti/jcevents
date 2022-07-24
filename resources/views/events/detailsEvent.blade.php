@extends('layouts.main')

@section('title', $event->title)

@section('content')

<div class="col-md-10 offset-md-1">
  <div class="shadow-lg p-3 mb-5 bg-white rounded">
    <div class="row">
      <div id="image-container" class="col-md-6">
        <img src="/img/events/{{ $event->image }}" class="img-fluid" alt="{{ $event->title }}">
      </div>
      <div id="info-container" class="col-md-6">
        <h1>{{ $event->title }}</h1>  
        <p class="events-date"><ion-icon name="time-outline"></ion-icon> <b>Data:&nbsp;</b>{{ date('d/m/Y',  strtotime($event->date))   }}</p>
        <p class="events-date"><ion-icon name="time-outline"></ion-icon> <b>início:&nbsp;</b> {{ $event->hora_inicio }}</p>
        <p class="events-date"><ion-icon name="time-outline"></ion-icon> <b>término:&nbsp;</b> {{ $event->hora_fim }}</p>
        <p class="events-participants"><ion-icon name="people-outline"></ion-icon> {{ count($event->users) }} Participantes até o momento</p>
        <p class="event-owner"><ion-icon name="star-outline"></ion-icon> <b>Responsável:&nbsp;</b> {{ $eventOwner['name'] }}</p>
        <p class="event-owner">&nbsp;<i class="bi bi-whatsapp"></i>&nbsp;&nbsp;<b>Contato:&nbsp;</b> {{ $eventOwner['phone'] }}</p>
        <p class="event-city"><ion-icon name="location-outline"></ion-icon> <b>Local:&nbsp;</b> {{ $event->address }}</p>
        <p><i class="bi bi-google">&nbsp;<a href="javascript:abrir('https://www.google.com.br/maps/place/{{ $event->address }}');">Ver endereço</a></i></p>
        @if(!$hasUserJoined)
          <form action="/event/joinEvent/{{ $event->id }}" method="POST">
            @csrf
            <a href="/event/joinEvent/{{ $event->id }}" 
              class="btn btn-primary" 
              id="event-submit"
              onclick="event.preventDefault();
              this.closest('form').submit();">
              Confirmar Presença
            </a>
          </form>
        @else
          <p class="already-joined-msg">Você já está participando deste evento!</p>
        @endif
        <h3>O evento conta com:</h3>
        <ul id="items-list">
        @if($items_events)
          @foreach($items_events as $item)
            <li><ion-icon name="play-outline"></ion-icon> <span>{{ $item->description }}</span></li>
          @endforeach
        @endif
        </ul>
      </div>
      @if($linkYoutube != null)
      <div class="col-md-12" id="description-container">
        <h3>Descrição do evento:</h3>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $linkYoutube }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      @endif
      <div class="col-md-12" id="description-container">
        <h3>Sobre o evento:</h3>
        <p class="event-description">{{ $event->description }}</p>
      </div>
      
    </div>
  </div>
</div>
  <script>
    function abrir(URL) {
      window.open(URL, 'janela', 'width=1024, height=768, top=100, left=699, scrollbars=no, status=no, toolbar=no, location=no, menubar=no, resizable=no, fullscreen=no')
    }

  </script>

@endsection