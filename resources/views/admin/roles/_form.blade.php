<x-admin.form.input
    name="name"
    label="Name"
    :value="$role->name ?? null"
    required
    autofocus
/>

<div class="mb-3">
    <label class="form-label">Permissions</label>

    @error('permissions')
    <div class="text-danger small mb-2">{{ $message }}</div>
    @enderror

    <div class="row">
        @foreach ($permissions as $group => $groupPermissions)
            <div class="col-md-6 col-xl-4 mb-3">
                <div class="card h-100">
                    <div class="card-header py-2">
                        <strong>{{ ucfirst($group) }}</strong>
                    </div>

                    <div class="card-body">
                        @foreach ($groupPermissions as $permission)
                            <div class="form-check mb-2">
                                <input type="checkbox"
                                       id="permission-{{ $permission->id }}"
                                       name="permissions[]"
                                       value="{{ $permission->name }}"
                                       class="form-check-input"
                                    @checked(in_array($permission->name, old('permissions', $rolePermissions ?? []), true))>

                                <label for="permission-{{ $permission->id }}" class="form-check-label">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
