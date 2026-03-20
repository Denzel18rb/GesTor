@extends('layouts.dashboard')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="min-height:70vh;">

    <div class="card bg-dark text-light border-secondary shadow" style="width: 400px;">

        <div class="card-body">
            <style>
                .neon-text {
                    color: #39ff14;
                    text-shadow:
                        0 0 5px #39ff14,
                        0 0 10px #39ff14,
                        0 0 20px #00ff99;
                    animation: flicker 1.5s infinite alternate;
                }

                @keyframes flicker {
                    0% { opacity: 1; }
                    100% { opacity: 0.85; }
                }
            </style>

            <h3 class="text-center text-3xl font-3xl mb-4 neon-text">
                Crear Proyecto
            </h3>

            <form method="POST" action="{{ route('projects.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label text-light">
                        Nombre del proyecto
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control bg-black text-light border-secondary"
                           required>
                </div>

                <div class="d-flex justify-content-between">

                    <a href="{{ route('projects.index') }}"
                       class="btn btn-outline-light btn-sm">
                        Cancelar
                    </a>

                    <button type="submit"
                            class="btn"
                            style="background-color:#34d399; color:black;">
                        Guardar
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection