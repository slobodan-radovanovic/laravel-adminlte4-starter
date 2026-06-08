<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        abort_unless(auth()->user()?->can('view categories'), 403);

        $categories = Category::query()
            ->latest()
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        abort_unless(auth()->user()?->can('create categories'), 403);

        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Category::query()->create($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Category $category): View
    {
        abort_unless(auth()->user()?->can('edit categories'), 403);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        abort_unless(auth()->user()?->can('delete categories'), 403);

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
