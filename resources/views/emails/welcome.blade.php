{{-- resources/views/emails/welcome.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ config('app.name') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .email-container {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .content {
            padding: 40px 30px;
        }
        .welcome-message {
            font-size: 18px;
            color: #667eea;
            margin-bottom: 20px;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin: 20px 0;
        }
        .info-box h3 {
            margin-top: 0;
            color: #667eea;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 5px;
            font-weight: bold;
        }
        .button:hover {
            background-color: #5568d3;
        }
        .steps {
            margin: 20px 0;
        }
        .step {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        .step-number {
            background-color: #667eea;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 15px;
            flex-shrink: 0;
        }
        .step-content {
            flex: 1;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
        .divider {
            height: 1px;
            background-color: #e9ecef;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🎉 Welcome to {{ config('app.name') }}!</h1>
        </div>

        <div class="content">
            <p class="welcome-message">
                <strong>Hello {{ $userName }},</strong>
            </p>

            <p>
                Thank you for registering with {{ config('app.name') }}! We're excited to help you with your visa application journey.
            </p>

            <div class="info-box">
                <h3>📧 Your Account Details</h3>
                <p><strong>Email:</strong> {{ $userEmail }}</p>
                <p style="margin-bottom: 0;">You can use this email to log in to your account anytime.</p>
            </div>

            <div class="divider"></div>

            <h2 style="color: #667eea;">Getting Started - Next Steps</h2>
            
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <strong>Choose Your Visa Type</strong>
                        <p>Select the type of visa application you need (Fiance, Spouse, or Adjustment of Status).</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <strong>Complete Your Application</strong>
                        <p>Fill out the required forms step-by-step. Your progress is automatically saved.</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <strong>Submit for Review</strong>
                        <p>Once completed, submit your application for our team to review.</p>
                    </div>
                </div>

                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <strong>Download Your Documents</strong>
                        <p>After approval, download your complete PDF package with all required forms.</p>
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ $loginUrl }}" class="button">Log In to Your Account</a>
                <a href="{{ $dashboardUrl }}" class="button" style="background-color: #28a745;">Go to Dashboard</a>
            </div>

            <div class="info-box" style="border-left-color: #28a745;">
                <h3>💡 Need Help?</h3>
                <p>Our support team is here to assist you:</p>
                <ul style="margin-bottom: 0;">
                    <li>Check our Resource Center for guides and FAQs</li>
                    <li>Contact us through the messaging system in your dashboard</li>
                    <li>Email us at support@filipinafianceevisa.com</li>
                </ul>
            </div>
        </div>

        <div class="footer">
            <p style="margin-bottom: 10px;"><strong>{{ config('app.name') }}</strong></p>
            <p style="margin: 5px 0;">Making visa applications simple and stress-free</p>
            <p style="margin: 5px 0; font-size: 12px;">
                This email was sent to {{ $userEmail }}. 
                If you didn't create this account, please ignore this email.
            </p>
        </div>
    </div>
</body>
</html>