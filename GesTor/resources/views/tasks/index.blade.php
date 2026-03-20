@extends('layouts.dashboard')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-white">Tareas</h2>

    <button class="btn" style="background:#39ff14; color:black;"
            data-bs-toggle="modal" data-bs-target="#createTaskModal">
        + Nueva Tarea
    </button>
</div>

<!-- ===================== -->
<!-- 🔹 TUS TAREAS -->
<!-- ===================== -->

<h4 class="text-white mb-3">Tus tareas</h4>

<div class="row mb-5">
@forelse ($ownTasks as $task)
    <div class="col-md-4 mb-4">

        <div class="card bg-dark text-light border-success h-100">

            <div class="card-body">
                <h5 class="text-white">{{ $task->title }}</h5>

                <p class="text-light">Estado: {{ $task->state }}</p>
                <p class="text-light">Fecha: {{ $task->deadline }}</p>

                <div>
                    <strong class="text-white">Usuarios:</strong>
                    <ul class="mb-0 text-light">
                        @foreach ($task->users as $user)
                            <li>{{ $user->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="card-footer d-flex justify-content-between border-top border-secondary">

                <!-- EDITAR -->
                <button class="btn btn-sm btn-success"
                    onclick="openEditModal(
                        {{ $task->id }},
                        @js($task->title),
                        @js($task->state),
                        '{{ $task->deadline }}',
                        @js($task->users->pluck('id'))
                    )">
                    Editar
                </button>

                <!-- ELIMINAR -->
                <form method="POST"
                      action="{{ route('tasks.destroy', $task->id) }}"
                      onsubmit="return confirm('¿Eliminar tarea?')">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-sm btn-danger">
                        Eliminar
                    </button>
                </form>

            </div>

        </div>

    </div>
@empty
    <p class="text-white">No tienes tareas.</p>
@endforelse
</div>

<!-- ===================== -->
<!-- 🔹 TAREAS DONDE PARTICIPAS -->
<!-- ===================== -->

<h4 class="text-white mb-3">Tareas donde participas</h4>

<div class="row">
@forelse ($assignedTasks as $task)
    <div class="col-md-4 mb-4">

        <div class="card bg-dark text-light border-success h-100">

            <div class="card-body">
                <h5 class="text-white">{{ $task->title }}</h5>

                <p class="text-light">Estado: {{ $task->state }}</p>
                <p class="text-light">Fecha: {{ $task->deadline }}</p>

                <div>
                    <strong class="text-white">Usuarios:</strong>
                    <ul class="mb-0 text-light">
                        @foreach ($task->users as $user)
                            <li>{{ $user->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="card-footer border-top border-secondary text-center">
                <span class="text-secondary small">Asignado a ti</span>
            </div>

        </div>

    </div>
@empty
    <p class="text-white">No participas en tareas.</p>
@endforelse
</div>

<!-- ===================== -->
<!-- MODAL CREAR -->
<!-- ===================== -->

<div class="modal fade" id="createTaskModal">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light border-success">

            <div class="modal-header">
                <h5 class="text-white">Nueva Tarea</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('tasks.store') }}">
                @csrf

                <div class="modal-body">

                    <input type="hidden" name="project_id" value="{{ $projectId }}">

                    <div class="mb-3">
                        <label class="text-white">Título</label>
                        <input type="text" name="title"
                               class="form-control bg-black text-light border-secondary">
                    </div>

                    <div class="mb-3">
                        <label class="text-white">Estado</label>
                        <select name="state"
                                class="form-control bg-black text-light border-secondary">
                            <option value="pending">Pendiente</option>
                            <option value="in_progress">En progreso</option>
                            <option value="completed">Completado</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="text-white">Fecha límite</label>
                        <input type="date" name="deadline"
                               class="form-control bg-black text-light border-secondary">
                    </div>

                    <div class="mb-3">
                        <label class="text-white">Asignar usuarios</label>

                        <select name="users[]" multiple
                                class="form-control bg-black text-light border-secondary">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>

                        <small class="text-secondary">
                            Ctrl para seleccionar varios
                        </small>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button class="btn" style="background:#39ff14; color:black;">
                        Crear
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- ===================== -->
<!-- MODAL EDITAR -->
<!-- ===================== -->

<div class="modal fade" id="editTaskModal">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light border-success">

            <div class="modal-header">
                <h5 class="text-white">Editar Tarea</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form id="editTaskForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <input type="hidden" name="project_id" value="{{ $projectId }}">

                    <div class="mb-3">
                        <label class="text-white">Título</label>
                        <input type="text" name="title" id="editTitle"
                               class="form-control bg-black text-light border-secondary">
                    </div>

                    <div class="mb-3">
                        <label class="text-white">Estado</label>
                        <select name="state" id="editState"
                                class="form-control bg-black text-light border-secondary">
                            <option value="pending">Pendiente</option>
                            <option value="in_progress">En progreso</option>
                            <option value="completed">Completado</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="text-white">Fecha límite</label>
                        <input type="date" name="deadline" id="editDeadline"
                               class="form-control bg-black text-light border-secondary">
                    </div>

                </div>
                <div class="mb-3">
                    <label class="text-white">Asignar usuarios</label>

                    <select name="users[]" id="editUsers" multiple
                            class="form-control bg-black text-light border-secondary">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>

                    <small class="text-secondary">
                        Ctrl para seleccionar varios
                    </small>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button class="btn btn-success">
                        Guardar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
function openEditModal(id, title, state, deadline, users) {
    const form = document.getElementById('editTaskForm');

    form.action = `/tasks/${id}`;

    document.getElementById('editTitle').value = title;
    document.getElementById('editState').value = state;
    document.getElementById('editDeadline').value = deadline;

    // 🔥 seleccionar usuarios actuales
    const select = document.getElementById('editUsers');

    Array.from(select.options).forEach(option => {
        option.selected = users.includes(parseInt(option.value));
    });

    new bootstrap.Modal(document.getElementById('editTaskModal')).show();
}
</script>

@endsection