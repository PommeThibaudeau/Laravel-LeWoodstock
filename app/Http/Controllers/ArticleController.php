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

        Type::findOrFail($data['type']);
        $article->type_id = $data['type'];

        foreach($request->input('$matters') as $matter_id){
            Matter::findOrFail($matter_id);

            //@TODO HOW THE FUCK CAN I DO THIS

        }

        $article->save();

        foreach (request()->file('images') as $image){
            $path = $image->store('images');
            Image::create(['src' => $path, 'article_id' => $article->getKey()]);
        }

        return redirect('articles')->with([
            'message' => "L'article $article->designation a bien été enregistrée"
        ]);
    }

    public function edit($id){
        return view('articles.edit', ['article' => Article::findOrFail($id)]);
    }

    public function update($id, Request $request){
        $data = request()->validate([
            'designation' => 'required|max:255',
            'description' => 'required|max:255',
            'stock'       => 'required|numeric',
            'price'       => 'required|digits',
            'images.*'    => 'image',
        ]);

        $article =  Article::findOrFail($id);
        $article->update($data);

        foreach (request()->file('images') as $image){
            dump($image);
//          $path = $image->store('images');
//          Image::update(['src' => $path]);
        }

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
