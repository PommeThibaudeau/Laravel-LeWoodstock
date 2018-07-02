<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function create($article_id = null){
        $message = '';

        if($article_id !==null){
            $article = Article::findOrFail($article_id);
            $message = "\n\n\n\n\n\n Création ciblée : ".$article->designation;
        }

        return view('contacts.create', [
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

        $contact = Contact::create($data);
        Mail::send(new ContactMailer($contact));

        return redirect('contacts')->with([
            'message' => "Merci pour le message, on vous répond dès que possible !"
        ]);
    }
}