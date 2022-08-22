<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
       $users = user::all();
        return $users;
    }

    public function store(Request $request)
    {
        $users = new User();
        $users->name = $request->name;
        $users->apellido = $request->apellido;
        $users->rut = $request->rut;
        $users->email = $request->email;
        $users->fecha_nacimiento = $request->fecha_nacimiento;
        $users->password = $request->password;
        $users->img_persona = $request->img_persona;

        $users->save();
    }

    public function update(Request $request)
    {
        $users = User::findOrFail($request->id);
        $users->name = $request->name;
        $users->apellido = $request->apellido;
        $users->rut = $request->rut;
        $users->email = $request->email;
        $users->fecha_nacimiento = $request->fecha_nacimiento;
        $users->password = $request->password;
        $users->img_persona = $request->img_persona;

        $users->save();

        return($users);// devuelve el usuario actualizado
    }

    public function destroy(Request $request)
    {
        $users = User::destroy($request->id);
        return $users;
    }
}
