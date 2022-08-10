<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Event;
use App\Models\Course;
use App\Models\User;
use App\Models\Items;
use App\Models\EventsItems;
use App\Models\EventCategory;


class EventController extends Controller
{
    
    public function index() {

        $search = request('search');

        if($search != null) {

            $events = Event::buscar_eventos($search); // busca os eventos atraves do texto pesquisado
            $courses = Course::buscar_cursos($search); // busca os cursos atraves do texto pesquisado
    
        } else {

            $events = Event::Paginate(10); // carrega todos os eventos
            $courses = Course::Paginate(10); // carrega todos os cursos
                      
        }
            
        return view('welcome',['events' => $events, 'search' => $search, 'courses' => $courses]);

    }

    public function createEvent() {

        $items_events = Items::recuperarItemsEvents();

        $eventCategories = EventCategory::all();

        return view('events.createEvent',['items_events' => $items_events,'eventCategories' => $eventCategories]);
    }

    public function recordEvent(Request $request) {

        $event = new Event;
        $event->title = $request->title;
        $event->date = $request->date;
        $event->address = $request->endereco;
        $event->latitude = $request->latitude;
        $event->longitude = $request->longitude;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->hora_inicio = $request->horaInicio;
        $event->hora_fim = $request->horaFim;
        $event->linkYoutube = $request->linkYoutube;
        $event->event_type_id = $request->eventTypeId; 
       
        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;

        }

        if(!$event->image){ // caso nao seja selecionado a imagem, ele grava a padrao
            $event->image = 'no_image.png';
        }

        $user = auth()->user();
        $event->user_id = $user->id;
        
        
        $event->save(); //gravei na tabela de eventos

        $items = new EventsItems;

        $items->events_id = $event->id;
         
        if($request->items){
        
            foreach($request->items as $valor){
                
                $items->items_id = $valor;
                
                $gravar = EventsItems::inserir($items->events_id,$items->items_id); //gravando na tabela de events_items quando houver
        
            }
        }
        return redirect('/dashboard')->with('msg', 'Evento criado com sucesso!');

    }
    
    public function detailsEvent($id) {

        $event = Event::findOrFail($id);

        $user = auth()->user();

        $hasUserJoined = false;

        if($user) {

            $userEvents = $user->eventsAsParticipant->toArray();

            foreach($userEvents as $userEvent) { //verifica se o participante ja esta no evento
                if($userEvent['id'] == $id) {
                    $hasUserJoined = true;
                }
            }

        }

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        //dd($event->user_id);

        $items_events = Items::recuperarItemsEventsPeloId($id);

        $linkYoutube = strstr($event->linkYoutube,"=", false);

        $linkYoutubeFormatado = substr($linkYoutube,1);
        
        //dd($linkYoutubeFormatado);

        return view('events.detailsEvent', ['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined, 'items_events' => $items_events,'linkYoutube' => $linkYoutubeFormatado]);
        
    }

    public function dashboard() {

        $user = auth()->user();

        $events = $user->events; //eloquent

        return view('events.dashboard', ['events' => $events]);    
    }

    public function myEvent() {

        $user = auth()->user();


        $eventsAsParticipant = $user->eventsAsParticipant;

        return view('events.myEvent', 
            ['eventsasparticipant' => $eventsAsParticipant]
        );
    
    }

    public function deleteEvent($id, Request $request) {

        $id = $request->eventId;

        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento excluído com sucesso!');

    }

    public function deleteItemEvent($id, Request $request) {
        
        $itemId = $request->itemId;
        $eventId = $request->eventId;

        $user = auth()->user();

        $event = Event::findOrFail($eventId);

        //dd($itemId,$eventId);

        if($user->id != $event->user_id) { //se a pessoa tentar editar um evento que ele nao criou ele vai barrar
            return redirect('/dashboard')->with('msg', 'Voce não tem permissão neste módulo!');
        }
    
        $deletarItemEvento = EventsItems::excluir($eventId,$itemId);

        $items_events = Items::recuperarItemsEventsNaoSelecionadosPeloId($eventId); // recupera somente os itens que ainda não foram adicionados para este evento

        $items_selecionados = Items::recuperarItemsEventsPeloId($eventId); // recupera os items daquele evento

        $eventCategories = EventCategory::all(); // recupera a lista de categorias dos eventos


        // falta inserir uma mensagem de item salvo com sucesso!

        return view('events.editEvent', ['event' => $event, 'items_events' => $items_events , 'items_selecionados' => $items_selecionados,'eventCategories' => $eventCategories, 'msg' => 'Item excluído']);
        
    }

    public function editEvent($id) {

        $user = auth()->user();

        $event = Event::findOrFail($id);

        $eventCategories = EventCategory::all();

        if($user->id != $event->user_id) { //se a pessoa tentar editar um evento que ele nao criou ele vai barrar
            return redirect('/dashboard')->with('msg', 'Voce não tem permissão neste módulo!');
        }

        $items_events = Items::recuperarItemsEventsNaoSelecionadosPeloId($id); // recupera somente os itens que ainda não foram adicionados para este evento

        $items_selecionados = Items::recuperarItemsEventsPeloId($id); // recupera os items daquele evento

        return view('events.editEvent', ['event' => $event, 'items_events' => $items_events , 'items_selecionados' => $items_selecionados, 'eventCategories' => $eventCategories]);

    }

    public function updateEvent(Request $request) {  // atualiza no banco

        //$data = $request->all();

        // Image Upload
        if($request->image) {
            
            if($request->hasFile('image') && $request->file('image')->isValid()) {

                $requestImage = $request->image;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/events'), $imageName);

                $data['image'] = $imageName;

                Event::findOrFail($request->id)->update($data);

                return redirect('event/editEvent/'. $request->id)->with('msg', 'Imagem do evento foi alterada!');

            }

        }

        else{

            $data['event_type_id'] = $request->eventTypeId; 
            $data['title'] = $request->title;
            $data['date'] = $request->date;
            $data['hora_inicio'] = $request->horaInicio;
            $data['hora_fim'] = $request->horaFim;
            $data['linkYoutube'] = $request->linkYoutube;

            if($request->endereco != null){
                $data['address'] = $request->endereco;
            }
            
            $data['private'] = $request->private;
            $data['description'] = $request->description;
            $data['updated_at'] = date('Y/m/d H:i');
            
            Event::findOrFail($request->id)->update($data);

            echo json_encode($request);
            
            return;

        }
        
    }

    public function editItemEvent($id, Request $request){

        $user = auth()->user();

        $event = Event::findOrFail($id);

        if($user->id != $event->user_id) { //se a pessoa tentar editar um evento que ele nao criou ele vai barrar
            return redirect('/dashboard')->with('msg', 'Voce não tem permissão neste módulo!');
        }

        $events_id = $id;
        $items_id = $request->itemEvent;

        $incluirItemEvento = EventsItems::inserir($events_id,$items_id);

        $items_events = Items::recuperarItemsEventsNaoSelecionadosPeloId($id); // recupera somente os itens que ainda não foram adicionados para este evento

        $items_selecionados = Items::recuperarItemsEventsPeloId($id); // recupera os items daquele evento

        $eventCategories = EventCategory::all(); // recupera a lista de categorias dos eventos

        // falta inserir uma mensagem de item salvo com sucesso!

        return view('events.editEvent', ['event' => $event, 'items_events' => $items_events , 'items_selecionados' => $items_selecionados,'eventCategories' => $eventCategories], ['msg' => 'Item adicionado!']);

    }

    public function joinEvent($id) {

        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/event/myEvent')->with('msg', 'Sua presença está confirmada no evento: ' . $event->title);

    }

    public function leaveEvent($id,Request $request) {

        $id = $request->eventId;

        $user = auth()->user();

        $user->eventsAsParticipant()->detach($id);

        $event = Event::findOrFail($id);

        return redirect('/event/myEvent')->with('msg', 'Você saiu com sucesso do evento: ' . $event->title);

    }

}