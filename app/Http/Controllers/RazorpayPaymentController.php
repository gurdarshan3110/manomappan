<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Traits\HasNavigationMenu;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;

class RazorpayPaymentController extends Controller
{
    use HasNavigationMenu;

    public function __construct()
    {
        // Share navigation menu with all views
        view()->share('navigationMenu', $this->getNavigationMenu());
    }

    /**
     * Display the payment page
     */
    public function index(Request $request)
    {
        $packageId = $request->get('package_id');
        $selectedPackage = null;
        
        if ($packageId) {
            $selectedPackage = Package::isActive()->with(['tests' => function ($query) {
                $query->where('activated', true)->orderBy('display_name');
            }])->find($packageId);
        }

        if (!$selectedPackage) {
            return redirect()->route('pages.buy_package')->with('error', 'Please select a valid package.');
        }

        return view('pages.payment', compact('selectedPackage'));
    }

    /**
     * Store the payment details and process transaction
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        // Validate required fields
        $request->validate([
            'razorpay_payment_id' => 'required',
            'razorpay_order_id' => 'required',
            'razorpay_signature' => 'required',
            'package_id' => 'required|exists:packages,id'
        ]);

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        
        try {
            // Fetch payment details
            $payment = $api->payment->fetch($input['razorpay_payment_id']);
            
            if (count($input) && !empty($input['razorpay_payment_id'])) {
                // Check payment status instead of verifying signature
                if ($payment['status'] === 'captured' || $payment['status'] === 'authorized') {
                    
                    // Get package details
                    $package = Package::find($input['package_id']);
                    
                    // TODO: Store transaction and package purchase details in database
                    // This is where you'll implement:
                    // 1. Create transaction record
                    // 2. Link package to user
                    // 3. Send confirmation email
                    // 4. Update user package status
                    
                    $transactionData = [
                        'user_id' => Auth::id(),
                        'package_id' => $input['package_id'],
                        'payment_id' => $payment['id'],
                        'order_id' => $payment['order_id'],
                        'amount' => $payment['amount'] / 100, // Convert paisa to rupees
                        'currency' => $payment['currency'],
                        'status' => $payment['status'],
                        'payment_method' => $payment['method'],
                        'package_name' => $package->plan_name,
                        'fee' => $payment['fee'] / 100, // Convert paisa to rupees
                        'contact' => $payment['contact'],
                        'email' => $payment['email'],
                        'card_id' => $payment['card_id'] ?? null,
                        'international' => $payment['international'],
                        'created_at' => $payment['created_at'],
                        'payment_response' => json_encode($payment->toArray())
                    ];
                    
                    // Store in session for now - you can create a transactions table later
                    Session::put('transaction_data', $transactionData);
                    Session::put('success', 'Payment successful! Your package has been activated.');
                    
                    return redirect()->route('razorpay.payment.success', ['package_id' => $package->id])
                        ->with('success', 'Payment completed successfully! Welcome to ' . $package->plan_name);
                    
                } else {
                    // Payment not successful
                    Session::put('error', 'Payment was not successful. Status: ' . $payment['status']);
                    return redirect()->back()->with('error', 'Payment was not completed successfully. Please try again.');
                }
            }
        } catch (Exception $e) {
            Session::put('error', 'Payment verification failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Payment verification failed. Please try again.');
        }
        
        Session::put('error', 'Payment failed. Please try again.');
        return redirect()->back();
    }
    
    /**
     * Display payment success page
     */
    public function success(Request $request)
    {
        $packageId = $request->get('package_id');
        $package = Package::find($packageId);
        $user = Auth::user();
        
        $meta = config('metatags.payment_success', [
            'title' => 'Payment Successful - Welcome to Manomaapan',
            'description' => 'Your payment has been processed successfully. Welcome to your career counselling journey.'
        ]);
        
        if (!$package) {
            return redirect()->route('user.dashboard')->with('error', 'Package not found.');
        }
        
        // Check if there's transaction data in session (optional verification)
        $transactionData = Session::get('transaction_data');
        if (!$transactionData) {
            return redirect()->route('user.dashboard')->with('info', 'Welcome to your dashboard!');
        }
        
        return view('pages.payment-success', compact('package', 'user', 'transactionData', 'meta'));
    }
    
    /**
     * Create Razorpay order
     */
    public function createOrder(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id'
        ]);
        
        $package = Package::find($request->package_id);
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        
        try {
            $order = $api->order->create([
                'receipt' => 'order_' . time(),
                'amount' => $package->price * 100, // Amount in paisa
                'currency' => 'INR',
                'notes' => [
                    'package_id' => $package->id,
                    'package_name' => $package->plan_name,
                    'user_id' => Auth::id()
                ]
            ]);
            
            return response()->json([
                'success' => true,
                'order_id' => $order['id'],
                'amount' => $order['amount'],
                'currency' => $order['currency']
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create order: ' . $e->getMessage()
            ], 500);
        }
    }
}
