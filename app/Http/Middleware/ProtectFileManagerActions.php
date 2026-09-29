<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Laravel Filemanager changes files through GET requests without a CSRF token.
 * Its own interface sends them with AJAX, so only allow those actions as AJAX
 * requests; a link on another site can then no longer delete or rename files.
 */
class ProtectFileManagerActions
{
    private const ACTIONS = [
        'unisharp.lfm.getAddfolder',
        'unisharp.lfm.getCropImage',
        'unisharp.lfm.getNewCropImage',
        'unisharp.lfm.getRename',
        'unisharp.lfm.performResize',
        'unisharp.lfm.performResizeNew',
        'unisharp.lfm.doMove',
        'unisharp.lfm.getDelete',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->routeIs(self::ACTIONS) && ! $request->ajax()) {
            abort(403, 'File manager actions must come from the file manager.');
        }

        return $next($request);
    }
}
