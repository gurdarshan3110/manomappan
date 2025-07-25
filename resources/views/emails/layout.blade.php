<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Manomaapan')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background: linear-gradient(135deg, #0077AB 0%, #1a1818 100%);
            color: white;
            padding: 30px 40px;
            text-align: center;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            color: white;
        }

        .tagline {
            font-size: 14px;
            opacity: 0.9;
            font-weight: 300;
        }

        .email-content {
            padding: 40px;
        }

        .greeting {
            font-size: 20px;
            color: #1a1818;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .content-section {
            margin-bottom: 30px;
        }

        .content-section h2 {
            color: #0077AB;
            font-size: 18px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .content-section p {
            color: #555;
            margin-bottom: 15px;
            line-height: 1.8;
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            background: linear-gradient(135deg, #0077AB 0%, #1a1818 100%);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            text-align: center;
            margin: 10px 0;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 119, 171, 0.3);
        }

        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #0077AB;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 5px 5px 0;
        }

        .info-box h3 {
            color: #0077AB;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .highlight {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }

        .success-badge {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            margin: 10px 0;
        }

        .email-footer {
            background-color: #1a1818;
            color: white;
            padding: 30px 40px;
            text-align: center;
        }

        .footer-content {
            margin-bottom: 20px;
        }

        .footer-content h3 {
            color: #0077AB;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .contact-info {
            margin-bottom: 20px;
        }

        .contact-info p {
            margin-bottom: 8px;
            font-size: 14px;
            opacity: 0.9;
        }

        .social-links {
            margin: 20px 0;
        }

        .social-links a {
            color: #0077AB;
            text-decoration: none;
            margin: 0 10px;
            font-size: 14px;
        }

        .footer-note {
            font-size: 12px;
            opacity: 0.7;
            border-top: 1px solid #333;
            padding-top: 20px;
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th,
        .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #f8f9fa;
            color: #0077AB;
            font-weight: 600;
        }

        .table tr:hover {
            background-color: #f8f9fa;
        }

        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 0;
                border-radius: 0;
            }

            .email-header,
            .email-content,
            .email-footer {
                padding: 20px;
            }

            .btn {
                display: block;
                width: 100%;
                text-align: center;
            }

            .table {
                font-size: 12px;
            }

            .table th,
            .table td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="logo">Manomaapan</div>
            <div class="tagline">Find clarity in your career through self-insight and expert guidance</div>
        </div>

        <!-- Content -->
        <div class="email-content">
            @yield('content')
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <div class="footer-content">
                <h3>Contact Us</h3>
                <div class="contact-info">
                    <p><strong>Email:</strong> hello@manomaapan.com</p>
                    <p><strong>Support:</strong> support@manomaapan.com</p>
                    <p><strong>Phone:</strong> +91 9876543210</p>
                    <p><strong>Website:</strong> www.manomaapan.com</p>
                </div>

                <div class="social-links">
                    <a href="#">Facebook</a> |
                    <a href="#">Instagram</a> |
                    <a href="#">LinkedIn</a> |
                    <a href="#">Twitter</a>
                </div>
            </div>

            <div class="footer-note">
                <p>&copy; {{ date('Y') }} Manomaapan. All rights reserved.</p>
                <p>This email was sent to you because you have an account with Manomaapan.</p>
                <p>If you no longer wish to receive these emails, you can <a href="#" style="color: #0077AB;">unsubscribe here</a>.</p>
            </div>
        </div>
    </div>
</body>
</html>
