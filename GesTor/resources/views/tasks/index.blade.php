@extends('layouts.dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-white">Tareas</h2>

    <!-- BOTÓN MODAL -->
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createTaskModal">
        + Nueva Tarea
    </button>
</div>

<!-- LISTA DE TAREAS -->
<div class="row">
    @foreach ($tasks as $task)
        <div class="col-md-4 mb-4">
            <div class="card bg-dark text-light border-success">

                <div class="card-body">
                    <h5>{{ $task->title }}</h5>

                    <p class="text-muted">
                        Estado: {{ $task->state }}
                    </p>

                    <p class="text-muted">
                        Fecha: {{ $task->deadline }}
                    </p>

                    <!-- USUARIOS -->
                    <div>
                        <strong>Usuarios:</strong>
                        <ul class="mb-0">
                            @foreach ($task->users as $user)
                                <li>{{ $user->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    @endforeach
</div>

<!-- MODAL CREAR -->
<div class="modal fade" id="createTaskModal">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light border-success">

            <div class="modal-header">
                <h5>Nueva Tarea</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf

                <div class="modal-body">

                    <input type="hidden" name="project_id" value="{{ $projectId }}">

                    <div class="mb-3">
                        <label>Título</label>
                        <input type="text" name="title" class="form-control bg-black text-light">
                    </div>

                    <div class="mb-3">
                        <label>Estado</label>
                        <select name="state" class="form-control bg-black text-light">
                            <option value="pending">Pendiente</option>
                            <option value="in_progress">En progreso</option>
                            <option value="completed">Completado</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Fecha límite</label>
                        <input type="date" name="deadline" class="form-control bg-black text-light">
                    </div>

                    <!-- USUARIOS -->
                    <div class="mb-3">
                        <label>Asignar usuarios</label>

                        <select name="users[]" multiple class="form-control bg-black text-light">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>

                        <small class="text-muted">
                            Mantén Ctrl para seleccionar varios
                        </small>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button class="btn btn-success">
                        Crear
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection