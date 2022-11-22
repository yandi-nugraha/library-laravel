<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if(!Auth::user()->level == 'admin') {
            return redirect()->back();
        }
        return $next($request);
    }
}
