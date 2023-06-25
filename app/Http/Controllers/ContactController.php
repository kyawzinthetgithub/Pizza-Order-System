<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //direct user message
    public function userMessage()
    {
        $messages = Contact::paginate(5);

        return view('admin.contact.contact', compact('messages'));
    }

    // detail message
    public function detailMessage($id)
    {
        $details = Contact::where('id', $id)->first();
        // dd($details->toArray());
        return view('admin.contact.detail', compact('details'));
    }

    // detail message
    public function deleteMessage($id)
    {
        Contact::where('id', $id)->delete();
        return redirect()->route('admin#userMessage')->with(['delete' => 'Message Delete Success !']);
    }
}