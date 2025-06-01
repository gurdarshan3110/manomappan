<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class DashboardController extends Controller
{
    public function home()
    {
        $meta = config('metatags.dashboard_home');
        return view('pages.user.dashboard', compact('meta'));
    }
}
