<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class SupabaseAuthService
{
    private function base(): string
    {
        return rtrim((string) config('services.supabase.url'), '/');
    }
    private function key(): string
    {
        return (string) config('services.supabase.anon_key');
    }
    private function request()
    {
<<<<<<< HEAD
        if (!$this->base() || !$this->key()) {
            throw new RuntimeException('Supabase authentication is not configured.');
        }

        return Http::acceptJson()->withHeaders([
            'apikey'=>$this->key(),
            'Content-Type' => 'application/json',
        ]);
    }

    public function signup(string $email,string $password): array
    {
        $r = $this->request()->post($this->base() . '/auth/v1/signup', compact('email', 'password'));

        if($r->failed()) {
            throw new RuntimeException($r->json('msg') ?? $r->json('error_description') ?? 'Registration failed.');
        }

        return $r->json();
    }

    public function login(string $email,string $password): array
    {
        $r = $this->request()->post(
            $this->base() . '/auth/v1/token?grant_type=password',
            compact('email','password')
        );

        if($r->failed()) {
            throw new RuntimeException($r->json('error_description') ?? $r->json('msg') ?? 'Invalid email or password.');
        }

        return $r->json();
    }

    public function user(string $accessToken): array
    {
        $r = $this->request()->withToken($accessToken)->get($this->base() . '/auth/v1/user');

        if($r->failed()) {
            throw new RuntimeException('Your session has expired.');
        }

        return $r->json();
    }

    public function logout(string $accessToken): void
    {
        try {
            $this->request()->withToken($accessToken)->post($this->base() . '/auth/v1/logout');
            } catch (\Throwable) {
                // Silence exception to allow session destruction locally
            }
=======
        if (!$this->base() || !$this->key()) throw new RuntimeException('Supabase authentication is not configured.');
        return Http::acceptJson()->withHeaders(['apikey'=>$this->key(),'Content-Type'=>'application/json']);
    }
    public function signup(string $email,string $password): array
    {
        $r=$this->request()->post($this->base().'/auth/v1/signup',compact('email','password'));
        if($r->failed()) throw new RuntimeException($r->json('msg') ?? $r->json('error_description') ?? 'Registration failed.');
        return $r->json();
    }
    public function login(string $email,string $password): array
    {
        $r=$this->request()->asForm()->post($this->base().'/auth/v1/token?grant_type=password',compact('email','password'));
        if($r->failed()) throw new RuntimeException($r->json('error_description') ?? 'Invalid email or password.');
        return $r->json();
    }
    public function user(string $accessToken): array
    {
        $r=$this->request()->withToken($accessToken)->get($this->base().'/auth/v1/user');
        if($r->failed()) throw new RuntimeException('Your session has expired.');
        return $r->json();
    }
    public function logout(string $accessToken): void
    {
        try { $this->request()->withToken($accessToken)->post($this->base().'/auth/v1/logout'); } catch (\Throwable) {}
>>>>>>> 1553df9ff9197e2ee5364a3b590da2338cb45ecc
    }
}
