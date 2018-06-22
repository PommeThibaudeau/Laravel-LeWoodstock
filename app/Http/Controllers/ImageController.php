<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class ImageController extends Controller
{
    public function index(){
        return view('images.index', ['images' => Image::all()]);
    }

    public function show($id){
        return view('images.show', ['image' => $image =Image::findOrFail($id)]);
    }

}
