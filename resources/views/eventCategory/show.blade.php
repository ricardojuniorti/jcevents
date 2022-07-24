@extends('layouts.main')

@section('title', 'Gerenciar Categorias')

@section('content')

<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
  <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
  <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
</svg>&nbsp;Gerenciar Categorias</h1>   
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
        @if(count($eventCategories) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    
                    <th scope="col"><a href="/eventCategory/createEventCategory"><i class="bi bi-plus-circle-fill">Nova Categoria</i></a></th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eventCategories as $eventCategory)
                    <tr>
                        <td><a href="#" data-toggle="modal" data-target="#myModal" data-id="NOME:&#013;{{ $eventCategory->description }}&#013;&#013;STATUS:&#013;{{ $eventCategory->active  === 1  ? 'Ativo' : 'Inativo' }} &#013;&#013;DATA DO CADASTRO:&#013;{{ date( 'd/m/Y' , strtotime($eventCategory->created_at))}}&#013;&#013;ULTIMA ATUALIZAÇÃO:&#013;{{ date( 'd/m/Y' , strtotime($eventCategory->updated_at))}}" >{{ $eventCategory->id }}</a></td>
                        <td>{{ $eventCategory->description }}</td>
                        <td>{{ $eventCategory->active  === 1  ? "Ativo" : "Inativo" }}</td>
                        <td>
                            <a href="/eventCategory/editEventCategory/{{$eventCategory->id}}" class="btn btn-info edit-btn"><i class="bi bi-pencil-square"></i></a> 
                            <form action="/eventCategory/{{$eventCategory->id}}" method="POST">
                                @csrf
                                @method('DELETE')
        
                                <a href="#" class="btn btn-danger delete-btn"  data-toggle="modal"  data-id="{{ $eventCategory->id }}" data-target="#exampleModalCenter"><i class="bi bi-trash"></i></a>

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
                                        <p>Tem certeza excluir esta categoria?</p>
                                        <input type="hidden" id="eventTypeId" name="eventTypeId" value="">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
                                            <button type="submit"  class="btn btn-primary">Excluir categoria</button>
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
        {{ $eventCategories->links() }}
        <!-- The Modal visualizar User-->
        <div class="modal" id="myModal">
            <div class="modal-dialog">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                <h4 class="modal-title"><b>Visualizando Tipos</b></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
        
                    <textarea  id="userProfileIdView" rows="15" cols="41" name="userProfileIdView" value="" disabled></textarea>
                   
                </div>
                
            </div>
            </div>
        </div>
        @else
        
        <p>ainda não existe registros, <a href="#">criar categorias</a></p>
    
        @endif
    </div>
</div>

<script>

$('#exampleModalCenter').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var recipientId = button.data('id');

      var modal = $(this);
      modal.find('#eventTypeId').val(recipientId);
  });


$('#myModal').on('show.bs.modal', function (event) {
    
    var button = $(event.relatedTarget);
    var recipientId = button.data('id');

    var modal = $(this);
    modal.find('#userProfileIdView').val(recipientId);

    var user = document.querySelector("[id='userProfileIdView']");

    console.log(user.value);
});

</script>

@endsection


