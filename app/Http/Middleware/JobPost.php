<?php

namespace App\Http\Middleware;

use Closure;

class JobPost {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!$request -> get('employer_id')) {
            return redirect('job\create');
        }

        return $next($request);
    }

}
