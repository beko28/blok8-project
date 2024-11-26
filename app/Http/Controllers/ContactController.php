<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'bericht' => 'required|string|min:10',
        ]);

        Mail::raw($request->bericht, function ($message) use ($request) {
            $message->to('bekir12@live.nl')
                    ->subject('Nieuw contactbericht van ' . $request->naam)
                    ->from($request->email);
        });

        return back()->with('success', 'Je bericht is succesvol verzonden!');
    }
}
