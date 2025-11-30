<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class NoCache
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Solo aplicar headers si NO es un BinaryFileResponse (como Excel, PDFs, etc.)
        if (!($response instanceof BinaryFileResponse)) {
            $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
                     ->header('Pragma','no-cache')
                     ->header('Expires','Fri, 01 Jan 1990 00:00:00 GMT');
        }

        return $response;
    }
}
