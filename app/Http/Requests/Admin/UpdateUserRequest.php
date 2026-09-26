<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        /** @var User $user */
        $user = $this->route('user');

        if (! $this->user()?->can('edit users')) {
            return false;
        }

        return ! $user->isSuperAdmin() || $this->user()->can('manage super admins');
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'email_verified' => $this->boolean('email_verified'),
        ]);
    }

    public function rules(): array
    {
        $user = $this->route('user');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'email_verified' => ['nullable', 'boolean'],
            'roles' => ['nullable', 'array'],
            'roles.*' => [
                'string',
                Rule::exists('roles', 'name'),
                Rule::notIn($this->user()->can('manage super admins') ? [] : [User::SUPER_ADMIN_ROLE]),
            ],
        ];
    }
}
