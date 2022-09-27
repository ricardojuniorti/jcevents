<?php

namespace App\Http\Controllers;
use App\Models\Classe;
use App\Models\User;
use App\Models\MessageClasses;
use App\Models\ReadClasses;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function createClasse() {

        return view('classe.createClasse');
    }

    public function recordClasse(Request $request) {

        $classe = new Classe;
        $classe->title = $request->title;
        $classe->link_video = $request->link_video;
        $classe->active = $request->active;
        $classe->duration = $request->duration;
        $classe->sequence = $request->sequence;
        $classe->courses_id = $request->courses_id; 
       
        
        $classe->save(); //gravei na tabela de aula
         
        return redirect('/course/' . $classe->courses_id)->with('msg', 'Aula criada com sucesso!');

    }

    public function deleteClasse($id, Request $request) {

        $id = $request->classeId;

        $id_curso = $request->courseId;
       
        Classe::findOrFail($id)->delete();

        return redirect('/course/' . $id_curso)->with('msg', 'Aula excluída com sucesso!');

    }

    public function detailsClasse($id) {

        $classe = Classe::findOrFail($id);

        $classes = Classe::Paginate(8);

        $link_video = strstr($classe->link_video,"=", false);

        $linkVideoFormatado = substr($link_video,1);

        //$messageClasses = Classe::find($id)->message_classes; // procura a aula pelo id e retorna tb as mensagens vinculadas a esta aula.

        $messageClasses = MessageClasses::buscar_mensagens($id);

        $aulasLidas = ReadClasses::all(); //busca na tabela de aulas lidas ou nao 
    
        //dd($messageClasses);
        return view('classe.detailsClasse', ['classe' => $classe,'classes' => $classes,'linkVideoFormatado' => $linkVideoFormatado, 'messageClasses' => $messageClasses, 'aulasLidas' => $aulasLidas]);        
    }

    public function editClasse($id) {

        $classe = Classe::findOrFail($id);
        return view('classe.editClasse',['classe' => $classe]);
        
    }

    public function updateClasse(Request $request) {  // atualiza no banco


            $data['title'] = $request->title;
            $data['link_video'] = $request->link_video;
            $data['active'] = $request->active;
            $data['duration'] = $request->duration;
            $data['updated_at'] = date('Y/m/d H:i');
            
            Classe::findOrFail($request->id)->update($data);

            echo json_encode($request);
            
            return;
    
    }

    public function updateRead(Request $request) {  // atualiza no banco

        if($request->users_id != null && $request->classes_id != null ){

            $data['users_id'] = $request->users_id;
            $data['classes_id'] = $request->classes_id;
            $data['reading'] = $request->reading;

            //saber se ja existe esse registro na tabela
            $retornaLido = ReadClasses::buscar_lido($request->users_id,$request->classes_id);
            
            if($retornaLido != null){
                ReadClasses::atualizarAulaLida($request->users_id,$request->classes_id,$request->reading);    //rever 
            }
            else{
                $gravarLidoOuNao = new ReadClasses;
                $gravarLidoOuNao->users_id = $request->users_id; 
                $gravarLidoOuNao->classes_id = $request->classes_id;
                $gravarLidoOuNao->reading = $request->reading;
                $gravarLidoOuNao->save();               
            }
            
        }

        echo json_encode($request);
        
        return;

    }

    public function createMessage ($classeId, request $request){
        
        $user = auth()->user()->id;
        //dd($user);
        $messageClasses = new MessageClasses;
        $messageClasses->message = $request->message;
        $messageClasses->classe_id = $classeId;
        $messageClasses->user_id = $user;
        date_default_timezone_set('America/Sao_Paulo');
        $messageClasses->created_at = date('Y/m/d H:i', time());

        $messageClasses->save();
         
        return redirect('/classe/detailsClasse/' . $classeId);

    }

    public function deleteMessage ($idClasse, request $request){
              
        $idMessage = $request->messageId;


        MessageClasses::findOrFail($idMessage)->delete();

        return redirect('/classe/detailsClasse/' . $idClasse);

    }
}
