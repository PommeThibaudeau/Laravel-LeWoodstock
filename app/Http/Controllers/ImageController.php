<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class ImageController extends Controller
{
    public function index(){
        return view('images.index', ['images' => Image::all()]);
    }

    public function create(){
        return view('images.create', ['image' =>  new Image()]);
    }

    public function show($id){
        $image = new Image();
        $image->find($id);
        return view('images.show', ['image' => $image]);
    }

    public function edit($id){
        $image = new Image();
        $image->find($id);
        return view('images.edit', ['image' =>  $image]);
    }

    public function update($id, Request $request){
        $data = request()->validate([
            'src'   => 'required|max:255',
            'alt'   => 'required|max:255',
        ]);

        $image = new Image();
        $image->find($id)->update($data);

        return redirect('images')->with([
            'message' => 'Image enregistré avec succès'
        ]);
    }

    public function destroy($id){
        Image::destroy($id);

        return redirect('images')->with([
            'message' => 'Image supprimé avec succès'
        ]);
    }
}
