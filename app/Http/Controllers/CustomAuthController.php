<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomAuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }

    public function registration()
    {
        return view('auth.registration');
    }
    public function postLogin(Request $request)
    {
          $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');

        }
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');

    }
    public function postRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',

        ]);
        $data = $request->all();
        $check = $this->create($data);
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');

    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
        return redirect("login")->withSuccess('Opps! You do not have access');

    }

    public function create(array $data)

    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address'=>$data['address'],
            'gender'=>$data['gender'],
            'status'=>$data['status'],
            'password' => Hash::make($data['password'])
          ]);

    }

    public function logout() {

        Session::flush();
        Auth::logout();
        return Redirect('login');

    }
}
