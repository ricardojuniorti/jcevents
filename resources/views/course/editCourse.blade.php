@extends('layouts.main')

@section('title', 'Editando: ' . $course->title)

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
        <form action="/course/updateCourse/{{$course->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="shadow-none p-3 mb-5 bg-light rounded"><h1>Editando: {{ $course->title }}</h1></div>  
          <div class="form-group">
            <label for="image">Imagem do Curso:</label>
            <input type="file" id="image" name="image" class="from-control-file" onchange="previewImagem()" required>
            <img src="/img/events/{{ $course->image }}" alt="{{ $course->title }}" class="img-preview">
          </div>
          <button class="btn btn-success" id="alteraImagem">Alterar Imagem</button>
        </form><BR><BR>
        <form  name="formEdit" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group">
          <label for="title">Curso:</label><tag class="font-red">*</tag>
          <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" value="{{ $course->title }}" required>
        </div>
      
        <div class="form-group">
          <label for="title">Sobre o curso:</label>
          <textarea name="description" id="description" rows="10" maxlength="300" class="form-control" placeholder="O que vai acontecer no curso" required>{{ $course->description }}</textarea>
        </div>

        <div class="form-group">
          <label for="title">Ativo?</label><tag class="font-red">*</tag>
          <select name="active" id="active" class="form-control" required>
            <option value="0">Não</option>
            <option value="1"{{ $course->active == 1 ? "selected='selected'" : "" }}>Sim</option>
          </select>
        </div>

        <div class="form-group">
          <label for="title">Duração:</label><tag class="font-red">*</tag>
          <input type="text" class="form-control" id="duration" name="duration" placeholder="duracao" value="{{ $course->duration }}" required>
        </div>

        <BR>
        <input type="submit" id="buttonSubmit"  class="btn btn-primary" value="Atualizar">
        <a href="/course/show" id="btn_cancelar" class="btn btn-outline-warning">Cancelar</a>
      </form>
    </div>
  </div>
@endif
<script>
  $(function(){

      $('form[name="formEdit"]').submit(function(event){

        event.preventDefault();
        //console.log(response);

      $.ajax({
        url: "/course/updateCourse/{{$course->id}}",
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

  function previewImagem(){
				var imagem = document.querySelector('input[name=image]').files[0];
				var preview = document.querySelector('.img-preview');
				
				var reader = new FileReader();
				
				reader.onloadend = function () {
					preview.src = reader.result;
				}
				
				if(imagem){
					reader.readAsDataURL(imagem);
				}else{
					preview.src = "";
				}
  }

</script>


@endsection