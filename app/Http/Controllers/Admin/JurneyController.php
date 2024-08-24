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
                'leaving' => ['required', function ($attribute, $value, $fail) {
                    if (strtotime($value) < strtotime(date('Y-m-d'))) {
                        $fail('La data di partenza deve essere uguale o successiva alla data odierna.');
                    }
                }],
                'return' => ['required', function ($attribute, $value, $fail) use ($request) {
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

        $jurney = Jurney::where('user_id', Auth::id())->first();

        $jurney_start = Carbon::parse($jurney['leaving']);
        $jurney_end = Carbon::parse($jurney['return']);

        // Non modificare le date per operazioni interne
        // $jurney['leaving'] = Carbon::createFromFormat('Y-m-d', $jurney['leaving'])->format('d-m-Y');
        // $jurney['return'] = Carbon::createFromFormat('Y-m-d', $jurney['return'])->format('d-m-Y');

        $jurney_length = $jurney_end->diffInDays($jurney_start) + 1;

        for ($i = 0; $i < $jurney_length; $i++) {
            $date = $jurney_start->copy()->addDays($i);

            $newDay = new day();
            $newDay->jurney_id = $jurney->id;
            $newDay->date = $date->format('Y-m-d');
            $newDay->save();
        }


        return redirect()->route('admin.home');
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
    public function edit(jurney $jurney)
    {
        return view('admin.jurney.edit', compact('jurney'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jurney $jurney)
    {
        $form_data = $request->all();

        $val_data = $request->validate(
            [
                'title' => 'required|min:3|max:100',
                'destination' => 'required|min:3|max:100',
                'leaving' => ['required', function ($attribute, $value, $fail) {
                    if (strtotime($value) < strtotime(date('Y-m-d'))) {
                        $fail('La data di partenza deve essere uguale o successiva alla data odierna.');
                    }
                }],
                'return' => ['required', function ($attribute, $value, $fail) use ($request) {
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

        if ($form_data['title'] !== $jurney->title) {
            $form_data['slug'] = Helper::generateSlug($form_data['title'], Jurney::class);
        }

        $jurney->update($form_data);

        $jurney_start = Carbon::parse($form_data['leaving']);
        $jurney_end = Carbon::parse($form_data['return']);
        $jurney_length = $jurney_end->diffInDays($jurney_start) + 1;

        // Recupera le date già presenti nel DB per questo jurney
        $existingDays = day::where('jurney_id', $jurney->id)->get()->pluck('date')->toArray();

        // Rimuove i giorni che non rientrano più nel nuovo intervallo
        foreach ($existingDays as $existingDay) {
            if ($existingDay < $form_data['leaving'] || $existingDay > $form_data['return']) {
                day::where('jurney_id', $jurney->id)->where('date', $existingDay)->delete();
            }
        }

        // Aggiunge i nuovi giorni che rientrano nel nuovo intervallo
        for ($i = 0; $i < $jurney_length; $i++) {
            $date = $jurney_start->copy()->addDays($i)->format('Y-m-d');
            if (!in_array($date, $existingDays)) {
                $newDay = new day();  // Correggi il nome della classe: "Day" invece di "day"
                $newDay->jurney_id = $jurney->id;
                $newDay->date = $date;
                $newDay->save();
            }
        }

        return redirect()->route('admin.home');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jurney $jurney)
    {
        day::where('jurney_id', $jurney->id)->delete();
        $jurney->delete();
        return redirect()->route('admin.home');
    }
}
