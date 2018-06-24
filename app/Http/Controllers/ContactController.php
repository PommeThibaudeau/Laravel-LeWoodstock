<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Article;

class ContactController extends Controller
{
    /**
     * Show the contact form
     *
     * @return \Illuminate\Http\Response
     */
    public function create($article_id = null){
        $message = '';

        if($article_id !==null){
            $article = Article::findOrFail($article_id);
            $message = "\n\n\n\n\n\n Création ciblée : ".$article->designation;
        }

        return view('contact.create', [
            'message' => $message,
        ]);
    }

    /**
     * Send a mail with form datas
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Contact::create($data);

        return back()->with('success', 'Merci !');
    }
}