@extends('layouts.main')

@section('title', 'Editando Categoria: ' . $eventCategories->description)

@section('content')

<div id="event-create-container" class="col-md-6 offset-md-3">
  <div class="shadow-lg p-3 mb-5 bg-white rounded">
    <div class="alert alert-success messageBox" id="alerta" role="alert"></div>

    @if(session('msg'))
    <div class="alert alert-success" role="alerta" id="msgItem">{{ session('msg') }}</div>
      <script>
            setTimeout(function() {
              $('#msgItem').fadeOut('fast');
            }, 4000);
      </script>
    @endif
    @if(isset($msg))
    <div class="alert alert-success" role="alerta" id="msgItem">{{ $msg }}</div>
    <script>
          setTimeout(function() {
            $('#msgItem').fadeOut('fast');
          }, 4000);
    </script>
    @endif
      
      @csrf
      @method('PUT')
      <div class="shadow-none p-3 mb-5 bg-light rounded"><h1>Editando: {{ $eventCategories->description }}</h1></div>  
      <form  name="formEdit" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="title">Tipo:</label><tag class="font-red">*</tag>
        <input type="text" class="form-control" id="description" name="description" placeholder="Perfil" value="{{ $eventCategories->description }}" required>
      </div>
      <div class="form-group">
        <label for="title">Ativo?</label><tag class="font-red">*</tag>
        <select name="active" id="active" class="form-control" required>
          <option value="0">Não</option>
          <option value="1"{{ $eventCategories->active == 1 ? "selected='selected'" : "" }}>Sim</option>
        </select>
      </div>
      <BR>
      <input type="submit" id="buttonSubmit"  class="btn btn-primary" value="Atualizar">
      <a href="/eventCategory/show" id="btn_cancelar" class="btn btn-outline-warning">Voltar</a>
    </form>
  </div>
</div>
<script>
  $(function(){

      $('form[name="formEdit"]').submit(function(user){

        user.preventDefault();
        //console.log(response);

      $.ajax({
        url: "/eventCategory/updateEventCategory/{{$eventCategories->id}}",
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response){
          $('html,body').scrollTop(0);      
          var container = document.querySelector('#alerta');
          container.style.display = 'block';
          $('.messageBox').html('Dados atualizados com sucesso!');
          setTimeout(function() {
            $('#alerta').fadeOut('fast');
          }, 4000);
          //console.log(document.querySelector('#active').value);
        } 
      });

    });
    
  });
    
</script>


@endsection