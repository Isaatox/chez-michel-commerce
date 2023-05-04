<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;


class ContactController extends Controller
{
    public function getcontact()
    {
        return view('contact');
    }

    public function contactenvoie(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Mail::to('votre-email@exemple.com')->send(new ContactMail($validatedData));

        return redirect()->route('contact')->with('success', 'Votre message a été envoyé avec succès !');
    }
}