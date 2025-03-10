<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $user = Auth::user();

            return redirect()->route('home'); // Usa el nombre de la ruta

        }

        // Autenticación fallida
        return back()->withInput()->withErrors(['error' => 'Credenciales incorrectas']);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function register(Request $request)
    {
        
        // Validate the request
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'cedula' => 'required|integer|min:1000000|max:99999999', // Adjusted for 7-8 digits
            'email' => 'required|string|email|max:255|unique:users',
            
            'password' => 'required|string|confirmed', // Ensures password confirmation
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'dni' => $request->cedula,
            'email' => $request->email,
           
            'password' => Hash::make($request->password), // Hash the password
            'status' => 'Activo', // Set the status
        ]);

        // Assign the "cliente" role
        $user->assignRole('cliente');

        // Log in the user
        Auth::login($user);

        // Redirect to intended page after successful registration
        return redirect()->intended('/home');
    }
}
