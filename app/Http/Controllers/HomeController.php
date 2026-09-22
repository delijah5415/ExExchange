<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', ['assets' => Asset::where('is_active', true)->orderBy('symbol')->get()]);
    }

    public function exchange(): View
    {
        return view('exchange', ['assets' => Asset::where('is_active', true)->orderBy('symbol')->get()]);
    }

    public function faq(): View { return view('faq'); }
    public function agreement(): View { return view('agreement'); }
    public function contacts(): View { return view('contacts'); }
}
