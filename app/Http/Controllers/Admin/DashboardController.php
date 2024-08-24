<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurney;
use App\Models\day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $jurney = Jurney::where('user_id', Auth::id())->first();

        if(!$jurney){
            return view('admin.home');
        }

        $jurney_start = Carbon::parse($jurney['leaving']);
        $jurney_end = Carbon::parse($jurney['return']);

        $jurney['leaving'] = Carbon::createFromFormat('Y-m-d', $jurney['leaving'])->format('d/m/Y');
        $jurney['return'] = Carbon::createFromFormat('Y-m-d', $jurney['return'])->format('d/m/Y');

        $days = day::where('jurney_id', $jurney->id)->get();

        foreach ($days as $day) {
            $day->date = Carbon::createFromFormat('Y-m-d', $day->date)->format('d-m-Y');
        }

        return view('admin.days.index', compact('jurney', 'days'));
    }
}
