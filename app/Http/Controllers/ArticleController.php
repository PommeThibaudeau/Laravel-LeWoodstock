<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Image;

class ArticleController extends Controller
{
    public function index(){
        return view('articles.index', ['articles' => Article::all()]);
    }

    public function show($id){
        $article = new Article();
        $article->find($id);
        return view('articles.show', ['article' => $article]);
    }

    public function create(){
        return view('articles.create', ['article' =>  new Article()]);
    }

    public function store(Request $request){
        $data = request()->validate([
            'designation' => 'required|max:255',
            'description' => 'required|max:255',
            'stock'       => 'required|numeric',
            'price'       => 'required|numeric',
            'images.*'    => 'image',
        ]);

        $article = Article::create($data);

        foreach (request()->file('images') as $image){
            $path = $image->store('images');
            Image::create(['src' => $path, 'article_id' => $article->getKey()]);
        }

        return redirect('articles')->with([
            'message' => 'Article enregistré avec succès'
        ]);
    }

    public function edit($id){
        $article = new Article();
        $article->find($id);
        return view('articles.edit', ['article' => $article]);
    }

    public function update($id, Request $request){
        $data = request()->validate([
            'designation' => 'required|max:255',
            'description' => 'required|max:255',
            'stock'       => 'required|numeric',
            'price'       => 'required|digits',
            'images.*'    => 'image',
        ]);

        $article = new Article();
        $article->find($id)->update($data);

        foreach (request()->file('images') as $image){
            dump($image);
//          $path = $image->store('images');
//          Image::update(['src' => $path]);
        }

        return redirect('articles')->with([
            'message' => 'Article enregistré avec succès'
        ]);
    }

    public function destroy($id){
        Article::destroy($id);

        return redirect('articles')->with([
            'message' => 'Article supprimé avec succès'
        ]);
    }

}
