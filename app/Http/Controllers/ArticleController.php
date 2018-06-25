<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Image;
use App\Matter;
use App\Type;

class ArticleController extends Controller{

  /**
   * Articles View
   *
   * @param Request $request
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index(Request $request){

    // Paginate
    $item_per_page = 9;

    // Base request
    $articles = Article::where('id', '>', '0');

    /* Reset filters */
    if(!empty($request->input('reset'))){
      $request->session()->forget('search');
      $request->session()->forget('matters');
      $request->session()->forget('type');
    }

    /* Search Filter */
    $search_filter = '';
    if(!empty($request->input('search')) || $request->session()->exists('search')){

      $search_filter = !empty($request->input('search'))
        ? $request->input('search')
        : $request->session()->get('search');

      $request->session()->put('search', $search_filter);

      // Filter request
      $articles->where('designation', 'LIKE', "%{$search_filter}%");
    }

    /* Matters Filter */
    $matters_filter = '';
    if(!empty($request->input('matters')) || $request->session()->exists('matters')){

      $matters_filter = !empty($request->input('matters'))
        ? $request->input('matters')
        : $request->session()->get('matters');

      // Matters verification
      $mattersFilter = collect();
      foreach($matters_filter as $matter_id){
        Matter::findOrFail($matter_id);
        $mattersFilter->push($matter_id);
      }

      $request->session()->put('matters', $matters_filter);

      // Filter request, keep an article if it contains at least one of the matters selected
      $articles->whereHas('matters', function($query) use ($mattersFilter){
        $query->whereIn('id', $mattersFilter);
      });
    }

    /* Type Filter */
    $type_filter = '';
    if(!empty($request->input('type')) || $request->session()->exists('type')){

      $type_filter = !empty($request->input('type'))
        ? $request->input('type')
        : $request->session()->get('type');

      // Type verification
      Type::findOrFail($type_filter);

      $request->session()->put('type', $type_filter);

      // Filter request
      $articles->where('type_id', $type_filter);
    }

    $articles    = $articles->paginate($item_per_page);
    $page_number = ceil($articles->total() / $articles->perPage());

    return view('articles.index', [
      'article'        => new Article(),
      'articles'       => $articles,
      'page_number'    => $page_number,
      'search_filter'  => $search_filter,
      'types'          => collect([''])->union(Type::all()->pluck('designation', 'id')),
      'type_filter'    => $type_filter,
      'matters'        => Matter::all()->pluck('designation', 'id'),
      'matters_filter' => $matters_filter,
    ]);
  }

  /**
   * Article View
   *
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function show($id){
    return view('articles.show', ['article' => Article::findOrFail($id)]);
  }

  /**
   * Creation Form
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function create(){
    return view('articles.create', [
      'article' => new Article(),
      'types'   => Type::all()->pluck('designation', 'id'),
      'matters' => Matter::all()->pluck('designation', 'id'),
    ]);
  }

  /**
   * Creation Form Result
   *
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function store(Request $request){
    $data = request()->validate([
      'designation' => 'required|max:255',
      'description' => 'required',
      'stock'       => 'required|numeric',
      'price'       => 'required|numeric',
      'type'        => 'required',
      'matters'     => 'required',
      'images'      => 'required',
      'images.*'    => 'mimes:jpg,jpeg,png,bmp',
    ]);

    $article              = new Article();
    $article->designation = $data['designation'];
    $article->description = $data['description'];
    $article->stock       = $data['stock'];
    $article->price       = $data['price'];

    /* Id verification for Type select */
    Type::findOrFail($data['type']);
    $article->type_id = $data['type'];
    $article->save();

    /* Ids verifications for Matter multiple select */
    $matters = [];
    foreach($request->input('matters') as $matter_id){
      Matter::findOrFail($matter_id);
      $matters[] = $matter_id;
    }

    /* Populate pivot table  */
    $article->matters()->sync($matters);

    /* Images upload  */
    foreach(request()->file('images') as $image){
      $path = $image->store('images');
      Image::create(['src' => $path, 'article_id' => $article->getKey()]);
    }

    return redirect('articles')->with([
      'message' => "L'article $article->designation a bien été enregistrée",
    ]);
  }

  /**
   * Edition Form
   *
   * @param $id
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function edit($id){
    return view('articles.edit', [
      'article' => Article::findOrFail($id),
      'types'   => Type::all()->pluck('designation', 'id'),
      'matters' => Matter::all()->pluck('designation', 'id'),
    ]);
  }

  /**
   * Edition Form Result
   *
   * @param $id
   * @param Request $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function update($id, Request $request){

    /* Fields verifications */
    $data = request()->validate([
      'designation' => 'required|max:255',
      'description' => 'required',
      'stock'       => 'required|numeric',
      'price'       => 'required|numeric',
      'type'        => 'required',
      'matters'     => 'required',
      'images.*'    => 'mimes:jpg,jpeg,png,bmp',
    ]);

    /* Populate basic infos*/
    $article              = Article::findOrFail($id);
    $article->designation = $data['designation'];
    $article->description = $data['description'];
    $article->stock       = $data['stock'];
    $article->price       = $data['price'];

    /* Id verification for Type select */
    Type::findOrFail($data['type']);
    $article->type_id = $data['type'];

    /* Ids verifications for Matter multiple select */
    $matters = [];
    foreach($request->input('matters') as $matter_id){
      Matter::findOrFail($matter_id);
      $matters[] = $matter_id;
    }

    /* Populate pivot table  */
    $article->matters()->sync($matters);

    /* Update images */
    $images_inputs = request()->file('images');
    $imageModel    = new Image();
    $images        = $imageModel->where('article_id', $id)->pluck('src', 'id')->toArray();

    $counter = 0;
    foreach($images as $id => $image_src){

      /* If image position < objects count in base -> update */
      if(isset($images_inputs[$counter])){
        $currentImage = $imageModel->find($id);

        /* Images upload  */
        $path = $images_inputs[$counter]->store('images');

        $currentImage->src = $path;
        $currentImage->save();
      }
      else{
      }
      ++$counter;
    }

    /* If image position > objects count in base -> create */
    for($i = $counter; $i < 5; ++$i){
      if(isset($images_inputs[$i])){
        $path = $images_inputs[$counter]->store('images');
        Image::create(['src' => $path, 'article_id' => $article->getKey()]);
      }
    }

    $article->update();

    return redirect('articles')->with([
      'message' => "L'article $article->designation a bien été enregistrée",
    ]);
  }

  /**
   * Destroy Route
   *
   * @param $id
   * @return \Illuminate\Http\RedirectResponse
   */
  public function destroy($id){
    $article     = Article::findOrFail($id);
    $designation = $article->designation;
    Article::destroy($id);

    return redirect('articles')->with([
      'message' => "L'article $designation a bien été supprimé",
    ]);
  }
}
