<?php

namespace App\Http\Controllers\Admin;

use App\functions\Helper;
use App\Http\Controllers\Controller;
use App\Models\Jurney;
use App\Models\stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    public function show(stage $stage)
    {
        $jurney = Jurney::where('user_id', Auth::id())->first();
        if ($stage->day->jurney_id !== $jurney->id) {
            abort(404);
        } else {
            return view('admin.stages.show', compact('stage'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(stage $stage)
    {
        $userId = Auth::id();
        if($stage->day->jurney->user_id === $userId){

            $locationString = $stage->location; // ad esempio "napoli|40.8358846|14.2487679"

            // Dividi la stringa in un array usando |
            $locationParts = explode('|', $locationString);

            // Riassegna i valori a chiavi specifiche nell'array
            $stage->location = $locationParts[0];
            $stage->latitude = $locationParts[1];
            $stage->longitude = $locationParts[2];

            return view('admin.stages.edit', compact('stage'));

        }else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, stage $stage)
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

        if (array_key_exists('image', $form_data)) {

            $image_path = Storage::put('uploads', $form_data['image']);

            $form_data['image'] = $image_path;
        }


        if ($form_data['title'] !== $stage->title) {
            $form_data['slug'] = Helper::generateSlug($form_data['name'], stage::class);
        } else {
            $form_data['slug'] = $stage['slug'];
        }

        $stage->update($form_data);

        $day = $form_data['day_id'];

        return redirect()->route('admin.days.show', compact('day'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(stage $stage)
    {
        $day = $stage->day_id;

        $stage->delete();

        return redirect()->route('admin.days.show', compact('day'));
    }
}
