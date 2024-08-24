<?php

namespace App\Http\Controllers\Admin;

use App\functions\Helper;
use App\Http\Controllers\Controller;
use App\Models\stage;
use Illuminate\Http\Request;

class StageController extends Controller
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
        return view('admin.stages.create');
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
            ],
            [
                'title.required' => 'Il campo Titolo é obbligatorio',
                'title.min' => 'Il campo Titolo deve contenere almeno :min caratteri',
                'title.max' => 'Il campo Titolo non puó contenere piú di :max caratteri',
            ]
        );

        $form_data['location'] = $form_data['location'] . '|' . $form_data['latitude'] . '|' . $form_data['longitude'];

        $stage = new stage();
        $stage->title = $form_data['title'];
        $stage->slug = Helper::generateSlug($form_data['title'], stage::class);
        $stage->location = $form_data['location'];
        $stage->day_id = $form_data['day_id'];

        // dd($stage);
        $stage->save();

        $day = $form_data['day_id'];

        return redirect()->route('admin.days.show', compact('day'));
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
