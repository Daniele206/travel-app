<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurney;
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

        // Calcolo della differenza
        $jurney_length = $jurney_end->diffInDays($jurney_start);

        return view('admin.days.index', compact('jurney', 'jurney_length'));
    }
}
