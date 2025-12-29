<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use function Laravel\Prompts\confirm;
use Illuminate\Support\Facades\Auth; // <-- Add this

class UserController extends Controller
{
    // Show Register Form
    public function create() {
        return view('users.register');
    }

    public function store(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users','email')],
            'password' => 'required|confirmed|min:6'
        ]);

        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        Auth::login($user); // <-- Use Auth facade

        return redirect('/')->with('message', 'User created and logged in');
    }





















 
    
    // Logout User
    public function logout(Request $request){
        Auth::logout(); // <-- Use Auth facade

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('message', 'You have been logged out!');
    }

    // Show login Form
    public function login(){
        return view('users.login');
    }











    // Authenticate User
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(Auth::attempt($formFields)){  
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in!');
        } else {
            return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
        }
    }
}
