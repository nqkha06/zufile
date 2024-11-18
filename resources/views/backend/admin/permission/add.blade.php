<form class="card" action="{{ route('admin.roles.give', $role->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card-header">
        <h3 class="card-title">Thêm quyền cho vai trò: {{ $role->name }}</h3>
        <div class="card-actions">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l14 0" />
                    <path d="M5 12l6 6" />
                    <path d="M5 12l6 -6" />
                </svg>
                Quay lại
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <div class="row">
                @foreach ($permissions as $permission)
                    <div class="col-md-3">
                        <label class="form-check">
                            <input class="form-check-input" name="permission[]" value="{{ $permission->name }}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} type="checkbox">
                            <span class="form-check-label">{{ $permission->name }}</span>
                        </label>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <div class="card-footer text-end">
        <input value="Cập nhật" type="submit" class="btn btn-primary">
    </div>
</form>
