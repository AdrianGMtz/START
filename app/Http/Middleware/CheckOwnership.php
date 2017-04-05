<?php

namespace App\Http\Middleware;

use Closure;

class CheckOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $commission = $request->commission;
        $owner = $commission->user->id;

        if ($owner != auth()->user()->id) {
            return redirect('/commissions/' . $commission->id);
        }
        return $next($request);
    }
}
