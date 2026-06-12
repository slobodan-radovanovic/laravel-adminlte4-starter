<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): View
    {
        abort_unless(auth()->user()?->can('view users'), 403);

        $users = User::query()
            ->with('roles')
            ->latest()
            ->get();

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        abort_unless(auth()->user()?->can('create users'), 403);

        $roles = $this->roles();

        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'email_verified_at' => ($validated['email_verified'] ?? false) ? now() : null,
        ]);

        $user->syncRoles($validated['roles'] ?? []);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit(User $user): View
    {
        abort_unless(auth()->user()?->can('edit users'), 403);

        $roles = $this->roles();

        $userRoles = $user->roles()
            ->pluck('name')
            ->toArray();

        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        $roles = $validated['roles'] ?? [];

        if ($user->hasRole('Super Admin') && ! in_array('Super Admin', $roles, true)) {
            $superAdminCount = User::role('Super Admin')->count();

            if ($superAdminCount <= 1) {
                return redirect()
                    ->route('users.edit', $user)
                    ->with('error', 'You cannot remove the last Super Admin role.');
            }
        }

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'email_verified_at' => ($validated['email_verified'] ?? false) ? ($user->email_verified_at ?? now()) : null,
        ];

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        $user->syncRoles($roles);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        abort_unless(auth()->user()?->can('delete users'), 403);

        if ($user->is(auth()->user())) {
            return redirect()
                ->route('users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        if ($user->hasRole('Super Admin')) {
            $superAdminCount = User::role('Super Admin')->count();

            if ($superAdminCount <= 1) {
                return redirect()
                    ->route('users.index')
                    ->with('error', 'You cannot delete the last Super Admin user.');
            }
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }

    private function roles(): array
    {
        return Role::query()
            ->orderBy('name')
            ->pluck('name', 'name')
            ->toArray();
    }
}
