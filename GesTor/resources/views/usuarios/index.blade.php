<h1>Lista de Usuarios</h1>

<a href="{{ route('usuarios.create') }}">Crear Usuario</a>

<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Acciones</th>
    </tr>

    @foreach($usuarios as $usuario)
    <tr>
        <td>{{ $usuario->nombre }}</td>
        <td>{{ $usuario->correo }}</td>
        <td>
            <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}">Editar</a>

            <form action="{{ route('usuarios.destroy', $usuario->id_usuario) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
