@extends('layouts.main')

@section('title', 'Editando: ' . $user->name)

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
      <div class="shadow-none p-3 mb-5 bg-light rounded"><h1>Editando: {{ $user->name }}</h1></div>  
      <form  name="formEdit" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="title">Nome:</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nome do usuario" value="{{ $user->name }}" required>
      </div>
      <div class="form-group">
        <label for="title">email:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail ..." value="{{ $user->email }}" required>
      </div>
      <div class="form-group">
        <label for="title">Perfil de Acesso:</label>
        <select name="perfilAcesso" id="perfilAcesso" class="form-control">
          <option value="">--Escolha uma opção--</option>
        @foreach($userProfiles as $userProfile)
          @if($userProfile->active == 1)
            <option value="{{$userProfile->id}}"{{ $user->user_profile_id == $userProfile->id ? "selected='selected'" : "" }}>{{$userProfile->description}}</option>
          @endif
        @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="title">Telefone:</label>
        <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefone ..." value="{{ $user->phone }}">
      </div>
      <BR>
      <input type="submit" id="buttonSubmit"  class="btn btn-primary" value="Atualizar">
      <a href="/user/show" id="btn_cancelar" class="btn btn-outline-warning">Voltar</a>
    </form>
  </div>
</div>
<script>
  $(function(){

      $('form[name="formEdit"]').submit(function(user){

        user.preventDefault();
        //console.log(response);

      $.ajax({
        url: "/user/updateUser/{{$user->id}}",
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
          //console.log(response);
        } 
      });

    });
    
  });
    
</script>


@endsection