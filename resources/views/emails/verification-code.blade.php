<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Your Email - SecureStart™</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .content {
            padding: 40px 30px;
            text-align: center;
        }
        .code-container {
            background: #f1f5f9;
            border: 2px dashed #3b82f6;
            border-radius: 12px;
            padding: 30px;
            margin: 30px 0;
        }
        .verification-code {
            font-size: 48px;
            font-weight: 900;
            color: #1e3a8a;
            letter-spacing: 8px;
            margin: 0;
            font-family: 'Courier New', monospace;
        }
        .code-label {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .expiry-notice {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            font-size: 14px;
            color: #92400e;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px 30px;
            font-size: 12px;
            color: #6b7280;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .button {
            display: inline-block;
            background: #1e3a8a;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin: 20px 0;
        }
        .security-note {
            font-size: 13px;
            color: #64748b;
            margin-top: 30px;
            padding: 15px;
            background: #f8fafc;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SecureStart™</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Email Verification</p>
        </div>
        
        <div class="content">
            <h2 style="color: #1e3a8a; margin-bottom: 20px;">Welcome, {{ $user->name }}!</h2>
            
            <p style="font-size: 16px; margin-bottom: 30px;">
                Thank you for joining SecureStart™. To complete your registration and secure your account, 
                please verify your email address using the code below.
            </p>
            
            <div class="code-container">
                <div class="code-label">Your Verification Code</div>
                <div class="verification-code">{{ $code }}</div>
            </div>
            
            <div class="expiry-notice">
                <strong>⏱️ Important:</strong> This code will expire in 10 minutes for security reasons.
            </div>
            
            <p style="margin: 30px 0;">
                Enter this code in the verification form to activate your account and start your diagnostic assessment journey.
            </p>
            
            <div class="security-note">
                <strong>🔒 Security Notice:</strong> If you didn't create an account with SecureStart™, 
                please ignore this email. Your security is important to us.
            </div>
        </div>
        
        <div class="footer">
            <p>
                This email was sent to {{ $user->email }} because you registered for a SecureStart™ account.
            </p>
            <p style="margin: 10px 0 0 0;">
                © {{ date('Y') }} SecureStart™. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>