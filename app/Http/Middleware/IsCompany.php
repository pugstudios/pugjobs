<?php

namespace App\Http\Middleware;

use Closure;

class IsCompany {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!session('user') -> type == "employer") {
            return redirect('\\');
        }

        return $next($request);
    }

}
