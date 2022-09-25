<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Course;
use App\Models\User;
use App\Models\Visits;
use App\Models\DropoutsEvents;


class ReportController extends Controller
{
    public function eventTime() {

        $data = [
            'dadosUsuarios' => $this->dadosUsuarios(),
            'dadosEventos' => $this->dadosEventos(),
            'dadosVisitantes' => $this->dadosVisitantes(),
            'dadosParticipantes' => $this->dadosParticipantes(),
            'dadosDesistentes' => $this->dadosDesistentes(),
        ];
        //dd($data);
        return view('report.eventTime', ['data' => json_encode($data)]);
    }

    /**
     * dadosUsuarios
     *
     * @return array
     */
    public function dadosUsuarios(): array
    {

        //pega mes atual
        $mesAtual = date("m");
        $mesPassado = $mesAtual - 1;
        $mesRetrasado = $mesAtual - 2;

        $dadosUsuarios = [
            User::whereMonth('created_at', $mesAtual)->count(), // novos cadastros do mes atual
            User::whereMonth('created_at', $mesPassado)->count(),// mes passado
            User::whereMonth('created_at', $mesRetrasado)->count(), // mes retrasado
        ];

        return $dadosUsuarios;
    }

    /**
     * dadosEventos
     *
     * @return array
     */
    public function dadosEventos(): array
    {

        //pega mes atual
        $mesAtual = date("m");
        $mesPassado = $mesAtual - 1;
        $mesRetrasado = $mesAtual - 2;

        $evento = 1;
        $teatro = 2;
        $show = 4;

        $dadosEventos = [

            Event::where('event_type_id', $evento)->count(), // eventos
            Event::where('event_type_id', $teatro)->count(), // teatro
            Event::where('event_type_id', $show)->count(), // shows
            Course::all()->count(), // todos os cursos
        ];

        //dd($dadosEventos);
        return $dadosEventos;
    }

    /**
    * dadosVisitantes
    *
    * @return array
    */
    public function dadosVisitantes(): array
    {

        //pega mes atual
        $mesAtual = date("m");
        $mesPassado = $mesAtual - 1;
        $mesRetrasado = $mesAtual - 2;

        $dadosVisitantes = [

            Visits::whereMonth('created_at', $mesAtual)->count(),
            Visits::whereMonth('created_at', $mesPassado)->count(),
            Visits::whereMonth('created_at', $mesRetrasado)->count(),
            Visits::all()->count(), // todas visitas
        ];

        return $dadosVisitantes;
    }

    /**
     * dadosParticipantes
     *
     * @return array
     */
    public function dadosParticipantes(): array
    {
        //$userEvents = Event::recuperar_top3_eventos();
        //dd($userEvents);

        $dadosParticipantes = [
            Event::recuperar_top3_eventos()
        ];
        //dd($dadosParticipantes);
        
        return $dadosParticipantes;
    }

    /**
    * dadosDesistentes
    *
    * @return array
    */
    public function dadosDesistentes(): array
    {

        //pega mes atual
        $mesAtual = date("m");
        $mesPassado = $mesAtual - 1;
        $mesRetrasado = $mesAtual - 2;

        $dadosDesistentes = [

            DropoutsEvents::whereMonth('created_at', $mesAtual)->count(),
            DropoutsEvents::whereMonth('created_at', $mesPassado)->count(),
            DropoutsEvents::whereMonth('created_at', $mesRetrasado)->count(),
            DropoutsEvents::all()->count(),
        ];

        return $dadosDesistentes;
    }
}
