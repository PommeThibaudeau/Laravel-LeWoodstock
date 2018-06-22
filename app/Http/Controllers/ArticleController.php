<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Image;
use App\Matter;
use App\Type;

class ArticleController extends Controller
{
    public function index(){
        return view('articles.index', ['articles' => Article::all()]);
    }

    public function show($id){
        return view('articles.show', ['article' => Article::findOrFail($id)]);
    }

    public function create(){
        return view('articles.create', [
            'article' => new Article(),
            'types'   => Type::all()->pluck('designation', 'id'),
            'matters' => Matter::all()->pluck('designation', 'id'),
        ]);
    }

    public function store(Request $request){
        $data = request()->validate([
            'designation' => 'required|max:255',
            'description' => 'required|max:255',
            'stock'       => 'required|numeric',
            'price'       => 'required|numeric',
            'type'        => 'required',
            'images.*'    => 'image',
            'matters.*'   => 'required',
        ]);

        $article = new Article();
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
        foreach($request->input('$matters') as $matter_id){
            Matter::findOrFail($matter_id);
            $matters[] = $matter_id;
        }

        /* Populate pivot table  */
        $article->matters()->sync($matters);

        /* Images upload  */
        foreach (request()->file('images') as $image){
            $path = $image->store('images');
            Image::create(['src' => $path, 'article_id' => $article->getKey()]);
        }

        return redirect('articles')->with([
            'message' => "L'article $article->designation a bien été enregistrée"
        ]);
    }

    public function edit($id){
        return view('articles.edit', [
            'article' => Article::findOrFail($id),
            'types'   => Type::all()->pluck('designation', 'id'),
            'matters' => Matter::all()->pluck('designation', 'id'),
        ]);
    }

    public function update($id, Request $request){
        $data = request()->validate([
            'designation' => 'required|max:255',
            'description' => 'required|max:255',
            'stock'       => 'required|numeric',
            'price'       => 'required|numeric',
            'type'        => 'required',
            'images.*'    => 'image',
            'matters.*'   => 'required',
        ]);

        $article =  Article::findOrFail($id);
        $article->designation = $data['designation'];
        $article->description = $data['description'];
        $article->stock       = $data['stock'];
        $article->price       = $data['price'];

        /* Id verification for Type select */
        Type::findOrFail($data['type']);
        $article->type_id = $data['type'];


        /* Ids verifications for Matter multiple select */
        $matters = [];
        foreach($request->input('$matters') as $matter_id){
            Matter::findOrFail($matter_id);
            $matters[] = $matter_id;
        }

        /* Populate pivot table  */
        $article->matters()->sync($matters);

        /* Update images */
        $images_inputs = request()->file('images');
        $imageModel = new Image();
        $images = $imageModel->where('article_id', $id)->pluck('src', 'id')->toArray();

        $counter = 0;
        foreach ($images as $id => $image_src){
            if(isset($images_inputs[$counter])){
                $currentImage = $imageModel->find($id);

                /* Images upload  */
                $path = $images_inputs[$counter]->store('images');

                $currentImage->src = $path;
                $currentImage->save();
            }else{

            }
            ++$counter;
        }

        /* Add images */
        for ($i=$counter; $i<5; ++$i){
            if(isset($images_inputs[$i])){
                $path = $images_inputs[$counter]->store('images');
                Image::create(['src' => $path, 'article_id' => $article->getKey()]);
            }
        }

        $article->update();

        return redirect('articles')->with([
            'message' => "L'article $article->designation a bien été enregistrée"
        ]);
    }

    public function destroy($id){
        $article = Article::findOrFail($id);
        $designation = $article->designation;
        Article::destroy($id);

        return redirect('articles')->with([
            'message' => "L'article $designation a bien été supprimé"
        ]);
    }

}
