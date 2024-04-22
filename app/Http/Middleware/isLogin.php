<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        if(!Auth::check()){
            return redirect('login');
           }
        //    simpan data user pada variabel $user
           $user = Auth::user();
    
        //    jika user memiliki level sesuai pada kolom pada lanjutkan request
           if($user->role == $roles){
             return $next($request);
           }

        return redirect()->route('login')->with('isLogin', 'please login');
    }
}
