<h1>Crear Usuario</h1>

<form action="{{ route('usuarios.store') }}" method="POST">
    @csrf

    <input type="text" name="nombre" placeholder="Nombre"><br>
    <input type="text" name="apellido" placeholder="Apellido"><br>
    <input type="number" name="edad" placeholder="Edad"><br>
    <input type="text" name="telefono" placeholder="Teléfono"><br>
    <input type="email" name="correo" placeholder="Correo"><br>
    <input type="password" name="password" placeholder="Password"><br>

    <select name="estado">
        <option value="Pendiente">Pendiente</option>
        <option value="En Proceso">En Proceso</option>
        <option value="Terminado">Terminado</option>
    </select>

    <button type="submit">Guardar</button>
</form>
