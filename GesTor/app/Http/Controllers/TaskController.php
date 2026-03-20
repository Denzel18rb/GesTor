<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index($projectId)
    {
        $user = auth()->user();

        // Tareas creadas por ti
        $ownTasks = Task::with('users')
            ->where('project_id', $projectId)
            ->where('user_id', $user->id)
            ->get();

        // Tareas donde participas
        $assignedTasks = Task::with('users')
            ->where('project_id', $projectId)
            ->whereHas('users', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            })
            ->where('user_id', '!=', $user->id)
            ->get();

        $users = \App\Models\User::all();

        return view('tasks.index', compact(
            'ownTasks',
            'assignedTasks',
            'projectId',
            'users'
        ));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'state' => 'required|in:pending,in_progress,completed',
            'deadline' => 'required|date',
            'users' => 'array'
        ]);

        //  construir datos manualmente
        $data = $request->only([
            'project_id',
            'title',
            'state',
            'deadline'
        ]);

        //  asignar creador
        $data['user_id'] = auth()->id();

        $task = Task::create($data);

        //  pivot
        if ($request->users) {
            $task->users()->sync($request->users);
        }

        return back();
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->only([
                'title',
                'state',
                'deadline',
                'project_id'
            ]));

        if ($request->users) {
            $task->users()->sync($request->users);
        }

        return back();
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return back();
    }
}
