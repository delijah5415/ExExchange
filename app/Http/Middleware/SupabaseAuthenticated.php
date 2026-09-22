<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class SupabaseAuthenticated
{
 public function handle(Request $request, Closure $next){if(!$request->session()->has('supabase_token')||!$request->session()->has('supabase_user.id')) return redirect('/login')->with('error','Please sign in to continue.');return $next($request);}
}
