<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $jurney = Jurney::where('user_id', Auth::id())->first();

        return view('admin.home', compact('jurney'));

    }
}
