<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index($projectId)
    {
        $tasks = Task::with('users')
            ->where('project_id', $projectId)
            ->get();

        $users = \App\Models\User::all();

        return view('tasks.index', compact('tasks', 'projectId', 'users'));
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

        $task = Task::create($request->all());

        //aquí se usa la tabla pivote
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
        $task->update($request->all());

        if ($request->users) {
            $task->users()->sync($request->users);
        }

        return back();
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
