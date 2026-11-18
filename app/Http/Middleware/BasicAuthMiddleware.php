<?php

namespace App\Http\Middleware;

use Closure;

class BasicAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        $validUser = 'admin';
        $validPass = 'tokobaju123';

        $user = $request->getUser();
        $pass = $request->getPassword();

        if ($user !== $validUser || $pass !== $validPass) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. Basic Auth diperlukan untuk akses endpoint ini.'
            ], 401, ['WWW-Authenticate' => 'Basic']);
        }

        return $next($request);
    }
}