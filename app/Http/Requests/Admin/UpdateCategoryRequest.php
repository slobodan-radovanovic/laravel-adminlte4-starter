<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('edit categories') ?? false;
    }

    public function rules(): array
    {
        /** @var Category $category */
        $category = $this->route('category');

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($category),
            ],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->filled('slug')
                ? Str::slug($this->input('slug'))
                : Str::slug($this->input('name')),
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}
