<h1>Editar Usuario</h1>

<form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="nombre" value="{{ $usuario->nombre }}"><br>
    <input type="text" name="apellido" value="{{ $usuario->apellido }}"><br>
    <input type="number" name="edad" value="{{ $usuario->edad }}"><br>
    <input type="text" name="telefono" value="{{ $usuario->telefono }}"><br>
    <input type="email" name="correo" value="{{ $usuario->correo }}"><br>

    <select name="estado">
        <option value="Pendiente" {{ $usuario->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
        <option value="En Proceso" {{ $usuario->estado == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
        <option value="Terminado" {{ $usuario->estado =='Terminado' ? 'selected':''}}>Terminado</option>
    </select>

    <button type="submit">Actualizar</button>
</form>
