<?php

namespace App\Http\Controllers\Admin;

use App\functions\Helper;
use App\Http\Controllers\Controller;
use App\Models\day;
use App\Models\Jurney;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class JurneyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.jurney.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $form_data = $request->all();

        $val_data = $request->validate(
            [
                'title' => 'required|min:3|max:100',
                'destination' => 'required|min:3|max:100',
                'leaving' => 'required',
                'return' => ['required', 'date', function ($attribute, $value, $fail) use ($request) {
                    if (strtotime($value) < strtotime($request->leaving)) {
                        $fail('La data di ritorno deve essere uguale o successiva alla data di partenza.');
                    }
                }],
            ],
            [
                'title.required' => 'Il campo Titolo é obbligatorio',
                'title.min' => 'Il campo Titolo deve contenere almeno :min caratteri',
                'title.max' => 'Il campo Titolo non puó contenere piú di :max caratteri',
                'destination.required' => 'Il campo Meta é obbligatorio',
                'destination.min' => 'Il campo Meta deve contenere almeno :min caratteri',
                'destination.max' => 'Il campo Meta non puó contenere piú di :max caratteri',
                'leaving.required' => 'Il campo Partenza é obbligatorio',
                'return.required' => 'Il campo Ritorno é obbligatorio'
            ]
        );

        $form_data['slug'] = Helper::generateSlug($form_data['title'], Jurney::class);
        $newJurney = new Jurney();
        $newJurney->user_id = Auth::user()->id;
        $newJurney->fill($form_data);
        $newJurney->save();

        $jurney = Jurney::where('user_id', Auth::id())->first();

        $jurney_start = Carbon::parse($jurney['leaving']);
        $jurney_end = Carbon::parse($jurney['return']);

        $jurney['leaving'] = Carbon::createFromFormat('Y-m-d', $jurney['leaving'])->format('d-m-Y');
        $jurney['return'] = Carbon::createFromFormat('Y-m-d', $jurney['return'])->format('d-m-Y');


        $jurney_length = $jurney_end->diffInDays($jurney_start)+1;

        for ($i = 0; $i < $jurney_length; $i++) {

            $date = $jurney_start->addDays($i);

            $S_date = $date->toDateString();

            $F_date = Carbon::createFromFormat('Y-m-d', $S_date)->format('d-m-Y');

            $D_date = Carbon::parse($F_date);

            $newDay = new day();
            $newDay->jurney_id = $jurney->id;
            $newDay->date = $D_date;
            $newDay->save();
        }

        return view('admin.days.index', compact('jurney', 'jurney_length'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
