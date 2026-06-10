<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PluginExampleController extends Controller
{
    public function index(): View
    {
        abort_unless(auth()->user()?->can('view users'), 403);

        return view('admin.examples.plugins');
    }
}
