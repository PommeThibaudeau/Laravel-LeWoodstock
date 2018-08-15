<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Facades\Mail;
use App\Contact;
use App\Mail\ContactMailer;
use App\Article;

class ContactController extends Controller
{
    /**
     * Show the contact form
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $article = new Article();
        $contact = new Contact();

        if(isset($request->all()['article_id'])){
            $article_id = $request->all()['article_id'];
            $article = $article->findOrFail($article_id);
            $article_link = config()['app']['url']."/articles/".$article_id ;
            $contact->message = "\n\n\n\n\n\n\n\nCréation ciblée : ".$article->designation."\nLien vers l'article : ".$article_link;
        }

        return view('contacts.create', [
            'article' => $article,
            'contact' => $contact,
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

        $contact = Contact::create($data);
        Mail::send(new ContactMailer($contact));

        return redirect('contacts')->with([
            'message' => "Merci pour le message, on vous répond dès que possible !"
        ]);
    }
}