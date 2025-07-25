<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Receipt</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
        }

        .receipt-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 15px 10px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #0077AB;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #0077AB;
            margin-bottom: 5px;
        }

        .tagline {
            font-size: 10px;
            color: #666;
        }

        .receipt-title {
            background-color: #0077AB;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .info-section {
            margin-bottom: 10px;
        }

        .info-section h3 {
            color: #0077AB;
            font-size: 14px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .info-grid {
            display: table;
            width: 100%;
        }

        .info-row {
            display: table-row;
        }

        .info-label,
        .info-value {
            display: table-cell;
            padding: 8px 0;
            vertical-align: top;
        }

        .info-label {
            font-weight: bold;
            width: 40%;
            color: #555;
        }

        .info-value {
            width: 60%;
        }

        .payment-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .payment-table th,
        .payment-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .payment-table th {
            background-color: #f8f9fa;
            color: #0077AB;
            font-weight: bold;
        }

        .total-section {
            margin-top: 20px;
            border-top: 2px solid #0077AB;
            padding-top: 15px;
        }

        .total-row {
            display: table;
            width: 100%;
            margin-bottom: 5px;
        }

        .total-label,
        .total-value {
            display: table-cell;
            padding: 5px 0;
        }

        .total-label {
            width: 70%;
            text-align: right;
            font-weight: bold;
        }

        .total-value {
            width: 30%;
            text-align: right;
            font-weight: bold;
            font-size: 16px;
            color: #0077AB;
        }

        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
            color: #666;
        }

        .status-badge {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 10px;
            font-weight: bold;
            display: inline-block;
        }

        .company-details {
            text-align: left;
            margin-bottom: 20px;
        }

        .company-details h4 {
            color: #0077AB;
            margin-bottom: 5px;
        }

        .customer-details {
            text-align: right;
            margin-bottom: 20px;
        }

        .customer-details h4 {
            color: #0077AB;
            margin-bottom: 5px;
        }

        .two-column {
            width: 100%;
            display: table;
        }

        .column {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">Manomaapan</div>
            <div class="tagline">Find clarity in your career through self-insight and expert guidance</div>
        </div>

        <!-- Receipt Title -->
        <div class="receipt-title">
            PAYMENT RECEIPT
        </div>

        <!-- Company and Customer Details -->
        <div class="two-column">
            <div class="column">
                <div class="company-details">
                    <h4>From:</h4>
                    <p><strong>Manomaapan</strong></p>
                    <p>Email: hello@manomaapan.com</p>
                    <p>Phone: +91 9876543210</p>
                    <p>Website: www.manomaapan.com</p>
                </div>
            </div>
            <div class="column">
                <div class="customer-details">
                    <h4>To:</h4>
                    <p><strong>{{ $user->name }}</strong></p>
                    <p>{{ $user->email }}</p>
                    @if($user->phone)
                        <p>{{ $user->phone }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="info-section">
            <h3>Payment Information</h3>
            <div class="info-grid">
                <div class="info-row">
                    <div class="info-label">Receipt No:</div>
                    <div class="info-value">#{{ strtoupper(substr($payment->order_id, -8)) }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Payment Date:</div>
                    <div class="info-value">{{ $payment->created_at->format('M d, Y h:i A') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Payment Method:</div>
                    <div class="info-value">Online Payment (Razorpay)</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Payment ID:</div>
                    <div class="info-value">{{ $payment->payment_id }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Order ID:</div>
                    <div class="info-value">{{ $payment->order_id }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Status:</div>
                    <div class="info-value">
                        <span class="status-badge">{{ ucfirst($payment->status) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Package Details -->
        <div class="info-section">
            <h3>Package Details</h3>
            <table class="payment-table">
                <thead>
                    <tr>
                        <th>Package</th>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>{{ $payment->package->plan_name }}</strong></td>
                        <td>{{ $payment->package->description }}</td>
                        <td>₹{{ number_format($payment->amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Total Section -->
        <div class="total-section">
            <div class="total-row">
                <div class="total-label">Subtotal:</div>
                <div class="total-value">₹{{ number_format($payment->amount, 2) }}</div>
            </div>
            <div class="total-row">
                <div class="total-label">Taxes & Fees:</div>
                <div class="total-value">₹0.00</div>
            </div>
            <div class="total-row" style="border-top: 1px solid #ddd; padding-top: 10px; margin-top: 10px;">
                <div class="total-label" style="font-size: 18px;">Total Amount Paid:</div>
                <div class="total-value" style="font-size: 18px;">₹{{ number_format($payment->amount, 2) }}</div>
            </div>
        </div>

        <!-- Package Features -->
        @if($payment->package->features)
            <div class="info-section">
                <h3>Package Features</h3>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    @foreach(json_decode($payment->package->features, true) ?? [] as $feature)
                        <li style="margin-bottom: 5px;">{{ $feature }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Footer -->
        <div class="footer">
            <p><strong>Thank you for choosing Manomaapan!</strong></p>
            <p>This is a computer-generated receipt. No signature required.</p>
            <p>For support or queries, contact us at support@manomaapan.com</p>
            <p>&copy; {{ date('Y') }} Manomaapan. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
