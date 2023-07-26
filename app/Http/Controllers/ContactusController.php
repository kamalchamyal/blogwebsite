<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contactus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Jobs\SendContactFormEmail;
class ContactusController extends Controller
{


    public function index(){
        $category =Category::get();
        $currentTimestamp = time();
        $currentDateTime = date('d F. l Y. g:i A', $currentTimestamp);
        $contact=Contactus::get();
        return view('frontend.contactus',['contact'=>$contact,'category'=>$category,'currentDatetime'=>$currentDateTime]);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
            'message' => 'required',
        ]);

        $contact = Contactus::create($validatedData);

        if ($contact) {
            // Queue the email to be sent in the background with the correct data
            SendContactFormEmail::dispatch($validatedData)->onQueue('emails');

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to save data.']);
        }
    }


}

