@extends('layouts.dashboard')

@section('content')

<style>
    .neon-green {
        color: #39ff14;
        text-shadow:
            0 0 5px #39ff14,
            0 0 10px #39ff14,
            0 0 20px #00ff99;
    }

    .neon-green-hover:hover {
        text-shadow:
            0 0 10px #39ff14,
            0 0 20px #39ff14,
            0 0 40px #00ff99,
            0 0 80px #00ff99;
    }

    .card-neon {
        border: 1px solid #39ff14;
        box-shadow: 0 0 10px rgba(57,255,20,0.2);
        transition: 0.3s;
        cursor: pointer;
    }

    .card-neon:hover {
        box-shadow: 0 0 20px rgba(57,255,20,0.4);
    }

    .btn-neon-green {
        color: #39ff14;
        border: 1px solid #39ff14;
        background: transparent;
    }

    .btn-neon-green:hover {
        color: black;
        background: #39ff14;
        box-shadow:
            0 0 10px #39ff14,
            0 0 20px #39ff14,
            0 0 40px #00ff99;
    }

    .btn-neon-red {
        color: #ff4d4d;
        border: 1px solid #ff4d4d;
        background: transparent;
    }

    .btn-neon-red:hover {
        color: white;
        background: #ff0000;
        box-shadow:
            0 0 10px #ff0000,
            0 0 20px #ff0000,
            0 0 40px #ff4d4d;
    }
</style>

<!-- ========================= -->
<!-- 🔹 TUS PROYECTOS -->
<!-- ========================= -->

<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="text-white fw-bold">Tus Proyectos</h2>

    <a href="{{ route('projects.create') }}"
       class="btn"
       style="background-color:#39ff14; color:black;">
        + Crear Proyecto
    </a>
</div>

<div class="row mb-5">

@forelse ($ownProjects as $project)
    <div class="col-md-4 mb-4">

        <div class="card bg-dark text-light card-neon h-100"
             onclick="window.location='{{ route('tasks.index', $project->id) }}'">

            <div class="card-body">
                <h5 class="neon-green neon-green-hover">
                    {{ $project->name }}
                </h5>

                <p class="text-white">
                    Tareas: {{ $project->tasks_count }}
                </p>
            </div>

            <div class="card-footer d-flex justify-content-between">

                <!-- EDITAR -->
                <a href="#"
                   onclick="event.stopPropagation(); openEditModal({{ $project->id }}, @js($project->name))"
                   class="btn btn-sm btn-neon-green">
                    Editar
                </a>

                <!-- ELIMINAR -->
                <form method="POST"
                      action="{{ route('projects.destroy', $project->id) }}"
                      onclick="event.stopPropagation();">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-sm btn-neon-red">
                        Eliminar
                    </button>
                </form>

            </div>

        </div>

    </div>

@empty
    <p class="text-white">No tienes proyectos.</p>
@endforelse

</div>

<!-- ========================= -->
<!-- 🔹 PROYECTOS DONDE PARTICIPAS -->
<!-- ========================= -->

<h2 class="text-white fw-bold mb-3">Proyectos donde participas</h2>

<div class="row">

@forelse ($joinedProjects as $project)
    <div class="col-md-4 mb-4">

        <div class="card bg-dark text-light card-neon h-100"
             onclick="window.location='{{ route('tasks.index', $project->id) }}'">

            <div class="card-body">
                <h5 class="neon-green neon-green-hover">
                    {{ $project->name }}
                </h5>

                <p class="text-white">
                    Tareas: {{ $project->tasks_count }}
                </p>
            </div>

        </div>

    </div>

@empty
    <p class="text-white">No participas en proyectos.</p>
@endforelse

</div>

<!-- ========================= -->
<!-- 🔹 MODAL EDITAR -->
<!-- ========================= -->

<div class="modal fade" id="editProjectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark text-light border border-success">

            <div class="modal-header border-secondary">
                <h5 class="modal-title text-success">Editar Proyecto</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form id="editProjectForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <input type="text"
                           name="name"
                           id="projectName"
                           class="form-control bg-black text-light border-secondary">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit" class="btn btn-neon-green">
                        Guardar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
function openEditModal(id, name) {
    const form = document.getElementById('editProjectForm');
    const input = document.getElementById('projectName');

    form.action = `/projects/${id}`;
    input.value = name;

    new bootstrap.Modal(document.getElementById('editProjectModal')).show();
}
</script>

@endsection