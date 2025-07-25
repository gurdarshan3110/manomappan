<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Traits\HasNavigationMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserPaymentController extends Controller
{
    use HasNavigationMenu;

    public function __construct()
    {
        // Share navigation menu with all views
        view()->share('navigationMenu', $this->getNavigationMenu());
    }

    /**
     * Display user's payment history
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Get user's payments with package relationship and pagination
        $payments = Payment::where('user_id', $user->id)
            ->with('package')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $meta = [
            'title' => 'My Payments - Manomaapan',
            'description' => 'View your payment history and transaction details.'
        ];
        
        return view('user.payments', compact('payments', 'user', 'meta'));
    }
}
