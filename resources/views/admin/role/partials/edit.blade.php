<form id="editPermissionForm" action="{{ url('/update-permissions/' . $role->id) }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Permissions for {{ $role->name }}</label>
        <div class="checkbox-group">
            @foreach($permissions as $permission)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="permission-{{ $permission->id }}" name="permissions[]" value="{{ $permission->name }}"
                    {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                    <label class="form-check-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                </div>
            @endforeach
        </div>
    </div>
</form>

<style>
    .checkbox-group {
        max-height: 300px;
        overflow-y: auto;
    }
    .form-check {
        margin-bottom: 10px;
    }
</style>
