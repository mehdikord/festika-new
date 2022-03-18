<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class CheckManagerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = User::whereNotNull('api_token')->where('api_token',$request->header('Authorization'))->first();

        if (!empty($user) && !empty($user->role) && $user->role < 4){

            return $next($request);
        }
        return response()->json(['error'=>"unauthorized "],401);
    }
}
