<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class ImageController extends Controller{

  /**
   * Images View
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index(){
    return view('images.index', ['images' => Image::all()]);
  }

  /**
   * Image View
   *
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function show($id){
    return view('images.show', ['image' => $image = Image::findOrFail($id)]);
  }
}
