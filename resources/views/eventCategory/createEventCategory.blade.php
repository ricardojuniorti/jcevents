@extends('layouts.main')

@section('title', 'Nova categoria de evento: ')

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
      <div class="shadow-none p-3 mb-5 bg-light rounded"><h1>Novo tipo de evento</h1></div>  
      <form  name="formEdit" enctype="multipart/form-data">
      @csrf
      @method('POST')
      <div class="form-group">
        <label for="title">Perfil:</label><tag class="font-red">*</tag>
        <input type="text" class="form-control" id="description" name="description" placeholder="Perfil" value="" required>
      </div>
      <div class="form-group">
        <label for="title">Ativo?</label><tag class="font-red">*</tag>
        <select name="active" id="active" class="form-control" required>
          <option value="">--Escolha uma opção--</option>
          <option value="0">Não</option>
          <option value="1">Sim</option>
        </select>
      </div>
      <BR>
      <input type="submit" id="buttonSubmit"  class="btn btn-primary" value="Salvar">
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
        url: "/eventCategory",
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response){
          $('html,body').scrollTop(0);      
          var container = document.querySelector('#alerta');
          container.style.display = 'block';
          $('.messageBox').html('Tipo criado com sucesso!');
          $('#description').val("");
          $('#active').val("");
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