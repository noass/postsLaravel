<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request){
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:20', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'max:100', Rule::unique('users', 'password')]
        ],
        $messages = [
            'required' => 'The field is required and/or it has not/has reached minimum/maximum character count.'
        ]);

            $incomingFields['password'] = bcrypt($incomingFields['password']);
            $user = User::create($incomingFields);
            auth()->login($user);
            return redirect('/');
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function login(Request $request){
        $incomingFields = $request->validate([
            'loginName' => 'required',
            'loginPassword' => 'required'
        ],
        $messages = [
            'required' => 'The field is required and/or it has not/has reached minimum/maximum character count.'
        ]);

        if(auth()->attempt(['name' => $incomingFields['loginName'], 'password' => $incomingFields['loginPassword']])){
            $request->session()->regenerate();
        }

        return redirect('/');
    }
}
