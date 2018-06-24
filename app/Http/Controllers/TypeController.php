<?php

namespace App\Http\Controllers;

use App\Article;
use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{

    public function index() {
        return view("types.index", ['types' =>  Type::all()]);
    }

    public function show($id) {
        return view("types.show", ['type' => Type::findOrFail($id)]);
    }

    public function create() {
        return view("types.create", ['type' => new Type()]);
    }

    public function store(Request $request) {
        /* Check if the data are accurate */
        $data = request()->validate([
            'designation' => 'required|max:50',
            'image'       => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

        $type = new Type();
        $type->designation = $data['designation'];

        /* Optionnal: save image if there is one */
        if($data['image']){

            /* Upload the image */
            $file = request()->file('image');
            $path = $file->store('types');

            /* Store the image path */
            $type->image = $path;
        }

        $type->save();
        return redirect()->route('types.index')->with([
            'message' => "Le type $type->designation a bien été enregistré"
        ]);

    }

    public function edit($id){
        return view('types.edit', ['type' => Type::findOrFail($id)]);
    }


    public function update($id, Request $request){

        /* Check if the data are accurate */
        $data = request()->validate([
            'designation' => 'required|max:50',
            'image'       => 'mimes:jpg,jpeg,png,bmp',
        ]);

        $type = Type::findOrFail($id);
        $type->designation = $data['designation'];

        /* Optionnal: save image if there is one */
        if($data['image']){

            /* Upload the image */
            $file = request()->file('image');
            $path = $file->store('types');

            /* Store the image path */
            $type->image = $path;
        }

        $type->update();

        return redirect()->route('types.index')->with([
            'message' => "Le type $type->designation a bien été enregistré"
        ]);
    }

    public function destroy($id) {

        $type = Type::findOrFail($id);
        $designation = $type->designation;

        if (Article::whereTypeId($id)->count() > 0){
            $message = "Des articles sont liés à ce type, supprimez les et réessayez.";
        }else{
            $message = "Le type $designation a bien été supprimé";
            $type->delete();
        }

        return redirect()->route('types.index')->with([
            'message' => $message
        ]);
    }

}