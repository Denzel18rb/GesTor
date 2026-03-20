<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProjectController extends Controller
{


    public function index()
    {
        $user = Auth::user();

        // Tus proyectos
        $ownProjects = Project::withCount('tasks')
            ->where('user_id', $user->id)
            ->get();

        // Proyectos donde participas (a través de tareas)
        $joinedProjects = Project::withCount('tasks')
            ->whereHas('tasks.users', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            })
            ->where('user_id', '!=', $user->id)
            ->get();

        return view('projects.index', compact('ownProjects', 'joinedProjects'));
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