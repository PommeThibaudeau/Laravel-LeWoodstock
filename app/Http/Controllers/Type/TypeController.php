<?php

namespace App\Http\Controllers\Type;

use App\Http\Controllers\Controller;

class TypeController extends Controller
{

    public function index() {

//        $type = \App\Type::all();

        $faker =  \Faker\Factory::create('fr_FR');
        $types = [];

        for($i = 0; $i < 12; $i++) {
            $types[] = (object) [
                'id' => $faker->randomNumber(),
                'designation' => $faker->sentence(1)
            ];
        }

        return view('type/index', ['types' => $types]);
    }

    public function show($id) {

//        $type = \App\Offer::findOrFail($id);
        $type = 'fer';

        return view("type/show", ['type' => $type]);
    }

    public function create() {
        return view("type/new");
    }

    public function save(\Request $request) {


        /* Check if the data are accurate */
        $data = request()->validate([
            'type-designation' => 'required|max:50',
            'type-image' => 'image',
        ]);

        /* Call type model and register the designation */
//        $type = new \App\Type();
//        $type->designation = $data['type-designation'];

        /* Optionnal: save image if there is one */
        if($data['type-image']) {

            /* Save the image in the storage */
            $file = request()->file('type-image');
            $path = $file->store('types');

            /* Register the image path */
//            $type->image_url = $path;
        }

        /* Save the model */
//        $type->save();


        $name = $data['type-designation'];

        return redirect('/types')->with([
            'message' => "Le type $name a bien été enregistré"
        ]);
    }

    public function update($id) {

        //        $type = \App\Offer::findOrFail($id);
        $type = 'fer';

        return view("type/update", ['type' => $type]);
    }


}