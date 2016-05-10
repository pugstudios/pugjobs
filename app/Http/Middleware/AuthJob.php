<?php

namespace App\Http\Middleware;

use Closure;

class AuthJob {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (!$request -> session() -> get('user') || $request -> session() -> get('user') -> type != "employer") {
            return redirect('user\login') -> with('error', 'Must be logged in as an employer to post a job.');
        }

        return $next($request);
    }

}
