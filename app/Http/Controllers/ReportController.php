<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Event;
use App\Models\User;
use App\Models\Items;
use App\Models\EventsItems;


class ReportController extends Controller
{
    public function eventTime() {

        $data = [
            'dadosUsuarios' => $this->dadosUsuarios(),
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
}
