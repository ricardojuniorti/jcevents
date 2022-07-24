@extends('layouts.main')

@section('title', 'Criar Curso')

@section('content')

@if(auth()->user()->user_profile_id == 1)
  <script>alert("Voce não tem permissão para acessar esta página");window.location.href = "/";</script>
@else
  <div id="event-create-container" class="col-md-6 offset-md-3">
    <div class="shadow-lg p-3 mb-5 bg-white rounded">
      <div class="shadow-none p-3 mb-5 bg-light rounded"><h1>Crie o seu curso</h1></div>
      <form action="/course" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
          <label for="image">Imagem do Evento:(preferencia: 1200x400)</label>
          <input type="file" id="image" name="image" class="from-control-file" onchange="previewImagem()">
          <img id="preview" src="/img/events/no_image.png" style="width: 400px; height: 300px;">
        </div>
        
        <div class="form-group">
          <label for="title">Curso:<tag class="font-red">*</tag></label>
          <input type="text" class="form-control" id="title" name="title" placeholder="curso..." required>
        </div>
      
        <div class="form-group">
          <label for="title">Detalhes sobre curso:</label>
          <textarea name="description" id="description" rows="10" class="form-control" placeholder="detalhes..."></textarea>
        </div>
        <div class="form-group">
          <label for="title">Ativo?</label><tag class="font-red">*</tag>
          <select name="active" id="active" class="form-control" required>
            <option value="1">Sim</option>
            <option value="0">Não</option>     
          </select>
        </div>
        <div class="form-group">
          <label for="title">Duração:<tag class="font-red">*</tag></label>
          <input type="text" class="form-control" id="duration" name="duration" placeholder="duração do curso..." required>
        </div>
        <input type="submit" class="btn btn-primary" value="Salvar">
        <a href="/course/show" id="btn_cancelar" class="btn btn-outline-warning">Cancelar</a>
      </form>
    </div>
  </div>
@endif

<script>
			function previewImagem(){
				var imagem = document.querySelector('input[name=image]').files[0];
				var preview = document.querySelector('#preview');
				
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