@extends('layouts.app',['title'=>'Sign in — CryptoExchange'])
@section('content')
<section class="auth">
    <div class="panel">
        <div class="eyebrow">ACCOUNT</div>
        <h1>Sign in</h1>
        <p>Access your exchange orders and request new quotes.</p>
        
        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
            </div>
            
            <div class="field">
                <labelfor"password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
            </div>
            
            <button class="btn primary full">Sign in</button>
        </form>
        
        <p class="muted">No account? <a href="{{ route('register') }}">Create one</a>.</p>
    </div>
</section>
@endsection
