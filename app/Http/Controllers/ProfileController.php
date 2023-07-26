<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('backend.profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);


            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            if ($request->has('password')) {
                $user->password = Hash::make($request->input('password'));
            }

            $user->save();

            if($user){
                return true;
            }
            else
            {
                return false;
            }

    }
}
