<?php
namespace App\Http\Controllers;
use App\Services\SupabaseAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AuthController extends Controller
{
    public function showLogin(){return view('auth.login');}
    public function showRegister(){return view('auth.register');}
    public function register(Request $request,SupabaseAuthService $auth){
        $v=Validator::make($request->all(),['email'=>'required|email|max:255','password'=>'required|string|min:10|confirmed']);
        if($v->fails()) return back()->withErrors($v)->withInput();
        try{$data=$auth->signup($request->email,$request->password); if(!empty($data['access_token'])){$request->session()->regenerate();$request->session()->put('supabase_token',$data['access_token']);$request->session()->put('supabase_user',$data['user']??[]);return redirect('/account')->with('success','Account created successfully.');} return redirect('/login')->with('success','Account created. Check your email if verification is enabled.');}catch(Throwable $e){return back()->withErrors(['email'=>$e->getMessage()])->withInput();}
    }
    public function login(Request $request,SupabaseAuthService $auth){
        $v=Validator::make($request->all(),['email'=>'required|email','password'=>'required|string']);
        if($v->fails()) return back()->withErrors($v)->withInput();
        try{$data=$auth->login($request->email,$request->password);$request->session()->regenerate();$request->session()->put('supabase_token',$data['access_token']);$request->session()->put('supabase_refresh_token',$data['refresh_token']??null);$request->session()->put('supabase_user',$data['user']??[]);return redirect()->intended('/account');}catch(Throwable $e){return back()->withErrors(['email'=>$e->getMessage()])->withInput();}
    }
    public function logout(Request $request,SupabaseAuthService $auth){$token=$request->session()->pull('supabase_token');if($token)$auth->logout($token);$request->session()->invalidate();$request->session()->regenerateToken();return redirect('/')->with('success','You have been signed out.');}
}
