<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:30',
            'last_name' => 'required|max:30',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',
        ]);
        $request['password'] = bcrypt($request->password);
        $request['formatted_id'] = $this->generateFormattedID();

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'formatted_id' => $request->formatted_id,
            'email' => $request->email,
            'password' => $request->password
        ]);

        auth()->login($user);

        return redirect('/');
    }

    public function sign_out()
    {
        Auth::logout();
        return redirect('/');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/');
        } else {
            return redirect('/login');
        }
    }

    private function generateFormattedID()
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($i = 0; $i < 4; $i++) {
            $segment = '';

            for ($j = 0; $j < 4; $j++) {
                $segment .= $characters[mt_rand(0, strlen($characters) - 1)];
            }

            $string .= $segment . ' ';
        }

        return trim($string);
    }
}
