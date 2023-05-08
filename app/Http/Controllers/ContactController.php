<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function getContact()
    {
        return view('contact');
    }

    public function envoieContact(Request $request)
    {
        // Valider les données du formulaire
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Envoyer l'email
        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');

//        Mail::to('blier.evan@gmail.com')->send(new ContactMail($name, $email, $subject, $message));

        // Rediriger l'utilisateur avec un message de confirmation
        return redirect()->route('index');
    }
}
