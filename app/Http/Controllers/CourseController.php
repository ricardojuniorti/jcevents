<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Event;
use App\Models\Classe;
use App\Models\User;
use App\Models\DropoutsEvents;

class CourseController extends Controller
{


    public function index() {

        $search = request('search');

        if($search) {

            $courses = Course::buscar_cursos($search);
    
        } else {

            $events = Event::Paginate(8); // carrega todos os eventos
            $courses = Course::Paginate(8); // carrega todos os cursos
                      
        } 
            
        return view('course.welcome',['search' => $search, 'courses' => $courses]);

    }

    public function show(){

        $user = auth()->user();

        $courses = $user->courses;

        //dd($courses);

        return view('course.show', ['courses' => $courses]); 
          
    }

    public function createCourse() {

        return view('course.createCourse');
    }

    public function recordCourse(Request $request) {

        $course = new Course;
        $course->title = $request->title;
        $course->description = $request->description;
        $course->active = $request->active;
        $course->duration = $request->duration;
        
        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $course->image = $imageName;

        }

        if(!$course->image){ // caso nao seja selecionado a imagem, ele grava a padrao
            $course->image = 'no_image.png';
        }

        $user = auth()->user();
        $course->user_id = $user->id;
            
        $course->save(); //gravei na tabela de cursos

        return redirect('/course/show')->with('msg', 'Curso criado com sucesso!');

    }

    public function detailsCourse($id) {

        $course = Course::findOrFail($id);

        $classes = Classe::buscar_aulas($id);

        $user = auth()->user();

        $hasUserJoined = false;

        if($user) {

            $usercourses = $user->coursesAsParticipant->toArray();

            foreach($usercourses as $usercourse) { //verifica se o participante ja esta no courso
                if($usercourse['id'] == $id) {
                    $hasUserJoined = true;
                }
            }

        }

        $courseOwner = User::where('id', $course->user_id)->first()->toArray();

        //dd($course);

        return view('course.detailsCourse', ['course' => $course, 'courseOwner' => $courseOwner, 'hasUserJoined' => $hasUserJoined, 'classes' => $classes]);
        
    }

    public function myCourses() {
        
        //dd('opaaa');

        $user = auth()->user();

        $coursesAsParticipant = $user->coursesAsParticipant;

        return view('course.myCourses', 
            ['coursesasparticipant' => $coursesAsParticipant]
        );
    
    }

    public function editCourse($id) {

        $user = auth()->user();

        $course = Course::findOrFail($id);

        if($user->id != $course->user_id) { //se a pessoa tentar editar um evento que ele nao criou ele vai barrar
            return redirect('/course/show')->with('msg', 'Voce não tem permissão neste módulo!');
        }

        return view('course.editCourse', ['course' => $course]);

    }

    public function updateCourse(Request $request) {  // atualiza no banco

        // Image Upload
        if($request->image) {
            
            if($request->hasFile('image') && $request->file('image')->isValid()) {

                $requestImage = $request->image;

                $extension = $requestImage->extension();

                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

                $requestImage->move(public_path('img/events'), $imageName);

                $data['image'] = $imageName;

                Course::findOrFail($request->id)->update($data);

                return redirect('course/editCourse/'. $request->id)->with('msg', 'Imagem do curso foi alterada!');

            }

        }

        else{

            $data['title'] = $request->title;
            $data['description'] = $request->description;
            $data['active'] = $request->active;
            $data['duration'] = $request->duration;
            $data['updated_at'] = date('Y/m/d H:i');
            
            Course::findOrFail($request->id)->update($data);

            echo json_encode($request);
            
            return;

        }
        
    }

    public function deleteCourse($id, Request $request) {

        $id = $request->eventId;

        Course::findOrFail($id)->delete();

        return redirect('/course/show')->with('msg', 'Curso excluído com sucesso!');

    }

    public function joinCourse($id) {

        $user = auth()->user();

        $user->coursesAsParticipant()->attach($id);

        $course = Course::findOrFail($id);

        return redirect('/mycourses')->with('msg', 'Voce foi matriculado no curso: ' . $course->title);

    }

    public function leaveCourse($id,Request $request) {

        $idEvent = $request->eventId;
        $userId = auth()->user()->id;
        $user = auth()->user();

        if($idEvent != null && $userId != null){

            $user->coursesAsParticipant()->detach($idEvent);

            // grava o usuario e o evento na tabela de desistentes do evento
            //Origin é para saber se ele ta desistindo de um curso ou evento. Evento = E , Curso = C
            $desistenteEvento = new DropoutsEvents;
            $desistenteEvento->users_id = $userId;
            $desistenteEvento->events_id = $idEvent;
            $desistenteEvento->origin = "C";
            $desistenteEvento->save();
        }

        $course = Course::findOrFail($idEvent);

        return redirect('/mycourses')->with('msg', 'Você saiu com sucesso do curso: ' . $course->title);

    }

}
