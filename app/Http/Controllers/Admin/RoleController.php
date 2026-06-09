<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        abort_unless(auth()->user()?->can('view roles'), 403);

        $roles = Role::query()
            ->withCount('permissions')
            ->latest()
            ->get();

        return view('admin.roles.index', compact('roles'));
    }

    public function create(): View
    {
        abort_unless(auth()->user()?->can('create roles'), 403);

        $permissions = $this->groupedPermissions();

        return view('admin.roles.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request): RedirectResponse
    {
        $role = Role::query()->create([
            'name' => $request->validated('name'),
        ]);

        $role->syncPermissions($request->validated('permissions') ?? []);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function edit(Role $role): View
    {
        abort_unless(auth()->user()?->can('edit roles'), 403);

        $permissions = $this->groupedPermissions();

        $rolePermissions = $role->permissions()
            ->pluck('name')
            ->toArray();

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $role->update([
            'name' => $request->validated('name'),
        ]);

        $role->syncPermissions($request->validated('permissions') ?? []);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        abort_unless(auth()->user()?->can('delete roles'), 403);

        if ($role->name === 'Super Admin') {
            return redirect()
                ->route('roles.index')
                ->with('error', 'The Super Admin role cannot be deleted.');
        }

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }

    private function groupedPermissions()
    {
        return Permission::query()
            ->orderBy('name')
            ->get()
            ->groupBy(function (Permission $permission) {
                return explode(' ', $permission->name)[1] ?? 'general';
            });
    }
}
