<form action="{{ route('usuarios.store') }}" method="POST">
    @csrf

    <div class="row">
        <div class="mb-3 col-md-4">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3 col-md-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3 col-md-4">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-4">
            <label for="dni" class="form-label">Cédula</label>
            <input type="text" class="form-control" id="dni" name="dni" required>
        </div>

        <div class="mb-3 col-md-4">
            <label for="role" class="form-label">Rol</label>
            <select class="form-select" id="role" name="role" required>
                <option value="">Selecciona un rol</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 col-md-4">
            <label for="status" class="form-label">Estado</label>
            <select class="form-select" id="status" name="status" required>
                <option value="Activo" selected>Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Aceptar</button>
        
    </div>
</form>
