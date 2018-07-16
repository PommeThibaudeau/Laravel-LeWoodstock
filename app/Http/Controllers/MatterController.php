<?php

namespace App\Http\Controllers;

use App\Article;
use App\Matter;
use Illuminate\Http\Request;

class MatterController extends Controller{

  /**
   * Matters View
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index(){
    return view("matters.index", ['matters' => Matter::all()]);
  }

  /**
   * Matter View
   *
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function show($id){
    return view("matters.show", ['matter' => Matter::findOrFail($id)]);
  }

  /**
   * Creation Form
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function create(){
    return view("matters.create", ['matter' => new Matter()]);
  }

  /**
   * Creation Form Result
   *
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request){
    /* Check if the data are accurate */
    $data = request()->validate([
      'designation' => 'required|max:50',
      'image'       => 'mimes:jpg,jpeg,png,bmp',
    ]);

    $matter              = new Matter();
    $matter->designation = $data['designation'];

    /* Optionnal: save image if there is one */
    if(isset($data['image']) && !empty($data['image'])){

      /* Upload the image */
      $file = request()->file('image');
      $path = $file->store('matters');

      /* Store the image path */
      $matter->image = $path;
    }

    $matter->save();

    return redirect()->route('matters.index')->with([
      'message' => "La matière $matter->designation a bien été enregistrée",
    ]);
  }

  /**
   * Edition Form
   *
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function edit($id){
    return view('matters.edit', ['matter' => Matter::findOrFail($id)]);
  }

  /**
   * Edition Form Result
   *
   * @param $id
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update($id, Request $request){

    /* Check if the data are accurate */
    $data = request()->validate([
      'designation' => 'required|max:50',
      'image'       => 'mimes:jpg,jpeg,png,bmp',
    ]);

    $matter              = Matter::findOrFail($id);
    $matter->designation = $data['designation'];

    /* Optionnal: save image if there is one */
    if(isset($data['image']) && !empty($data['image'])){

      /* Upload the image */
      $file = request()->file('image');
      $path = $file->store('matters');

      /* Store the image path */
      $matter->image = $path;
    }

    $matter->update();

    return redirect()->route('matters.index')->with([
      'message' => "La matière $matter->designation a bien été enregistrée",
    ]);
  }

  /**
   * Destroy Route
   *
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy($id){

    $matter      = Matter::findOrFail($id);
    $designation = $matter->designation;

    if($matter->articles()->where('matter_id', $id)->count() > 0){
      $message = "Des articles sont liés à cette matière, supprimez les et réessayez.";
    }
    else{
      $message = "La matière $designation a bien été supprimée";
      $matter->delete();
    }

    return redirect()->route('matters.index')->with([
      'message' => $message,
    ]);
  }
}