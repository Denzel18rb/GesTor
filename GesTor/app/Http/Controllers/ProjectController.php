<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // Mostrar proyectos del usuario
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
    }

    // Formulario de creación
    public function create()
    {
        return view('projects.create');
    }

    // Guardar proyecto
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Project::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'tasks_count' => 0,
            'team_members_count' => 1
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto creado');
    }

    // Editar proyecto
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    // Actualizar
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $project->update([
            'name' => $request->name
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto actualizado');
    }

    // Eliminar
    public function destroy($id)
    {
        Project::destroy($id);

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto eliminado');
    }
}