<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function verlogin(){
        //verificar si el usuario ya ha iniciado sesión
        if(Auth::check()){
            return redirect()->route('welcome');
        }
        return view('login');
    }

    public function login(Request $request){
        //validar los datos del formulario
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials)){
            //si las credenciales son válidas, regenerar la sesión
            $request->session()->regenerate();
            
            //redireccionar a la ruta principal
            return redirect()->route('welcome')
                ->with('success','Bienvenido');
        }
        throw ValidationException::withMessages([
            'email' => ['Las credenciales no coinciden con nuestros registros.'],
        ]);
    }

    public function logout(Request $request){
        //desautenticar al usuario
        Auth::logout();

        //invalidate la sesión
        $request->session()->invalidate();

        //regenerar el token de sesión
        $request->session()->regenerateToken();

        //redireccionar a la página de inicio de sesión
        return redirect()->route('login')
            ->with('success','Has cerrado sesión');
    }

    public function verRegistro()
{
    return view('registro'); 
}

    public function registro(Request $request)
{
    // Validar
    $request->validate([
        'nombre' => 'required|string|max:100',
        'apellido' => 'required|string|max:100',
        'email' => 'required|email|unique:admin,email',
        'password' => 'required|min:6'
    ]);

    // Crear usuario
    Admin::create([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // Redirigir al login con mensaje
    return redirect()->route('login')->with('success','Registro exitoso, ahora puedes iniciar sesión.');
}
}
