<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $meta = config('metatags.home');
        return view('pages.home', compact('meta'));
    }

    public function login()
    {
        $meta = config('metatags.login');
        return view('pages.login', compact('meta'));
    }

    public function register()
    {
        $meta = config('metatags.register');
        return view('pages.register', compact('meta'));
    }

    public function about()
    {
        $meta = config('metatags.about');
        return view('pages.about', compact('meta'));
    }

    public function contact()
    {
        $meta = config('metatags.contact');
        return view('pages.contact', compact('meta'));
    }

    public function forgotPassword()
    {
        $meta = config('metatags.forgot_password');
        return view('pages.forgot_password', compact('meta'));
    }
}
