<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ComponentExampleController extends Controller
{
    public function forms(): View
    {
        $this->authorizeExamples();

        return view('admin.examples.components.forms');
    }

    public function submitForms(Request $request): RedirectResponse
    {
        $this->authorizeExamples();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'website' => ['nullable', 'url'],
            'password' => ['nullable', 'string', 'min:8'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'country' => ['required', 'string'],
            'languages' => ['nullable', 'array'],
            'languages.*' => ['string'],
            'framework' => ['nullable', 'string'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string', 'max:30'],
            'birthday' => ['nullable', 'date'],
            'meeting' => ['nullable', 'date'],
            'vacation' => ['nullable', 'string'],
            'newsletter' => ['boolean'],
            'accent' => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'volume' => ['nullable', 'integer', 'between:0,100'],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'attachments' => ['nullable', 'array'],
            'attachments.*' => ['string'],
            'content' => ['nullable', 'string'],
        ]);

        // Uploaded files are not kept; show their names instead.
        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->getClientOriginalName();
        }

        return redirect()
            ->route('examples.components.forms')
            ->with('success', 'The form was submitted and validated.')
            ->with('submitted', $validated);
    }

    public function upload(Request $request): JsonResponse
    {
        $this->authorizeExamples();

        $request->validate([
            'file' => ['required', 'file', 'max:5120', 'mimes:jpg,jpeg,png,gif,webp,pdf'],
        ]);

        $path = $request->file('file')->store('examples/uploads');

        return response()->json(['path' => $path]);
    }

    public function widgets(): View
    {
        $this->authorizeExamples();

        return view('admin.examples.components.widgets');
    }

    public function layout(): View
    {
        $this->authorizeExamples();

        return view('admin.examples.components.layout');
    }

    public function notifications(): JsonResponse
    {
        $this->authorizeExamples();

        return response()->json(['count' => random_int(0, 9)]);
    }

    private function authorizeExamples(): void
    {
        abort_unless(auth()->user()?->can('view users'), 403);
    }
}
