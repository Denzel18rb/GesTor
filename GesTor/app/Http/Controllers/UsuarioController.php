<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'edad' => $request->edad,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'password' => bcrypt($request->password),
            'estado' => $request->estado
        ]);

        return redirect()->route('usuarios.index');
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $usuario->update($request->all());

        return redirect()->route('usuarios.index');
    }

    public function destroy($id)
    {
        Usuario::destroy($id);
        return redirect()->route('usuarios.index');
    }
}
