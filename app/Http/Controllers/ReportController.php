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

        return view('report.eventTime');

    }
}
