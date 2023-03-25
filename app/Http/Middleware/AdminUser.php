<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (auth()->check() AND auth()->user()->active) {

            if (auth()->check() and auth()->user()->admin AND auth()->user()->active){
                return $next($request);
            } else {
                return redirect()->back()->with('error','Você não tem permissão para realizar essa tarefa!');
            }
        }
        Auth::logout();
        return redirect('/login')->with('error','Desculpe, mas o Usuário está desativado.');
    }
}
