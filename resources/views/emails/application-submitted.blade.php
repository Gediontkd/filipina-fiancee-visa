{{-- resources/views/emails/application-submitted.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Application Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4F46E5;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9fafb;
            padding: 30px;
            border: 1px solid #e5e7eb;
        }
        .info-row {
            margin-bottom: 15px;
            padding: 10px;
            background-color: white;
            border-left: 3px solid #4F46E5;
        }
        .label {
            font-weight: bold;
            color: #4B5563;
            display: inline-block;
            width: 150px;
        }
        .value {
            color: #1F2937;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6B7280;
            font-size: 14px;
        }
        .alert {
            background-color: #EFF6FF;
            border: 1px solid #BFDBFE;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">New Application Submission</h1>
    </div>

    <div class="content">
        <p>A new application has been submitted. Please find the details below:</p>

        <div class="info-row">
            <span class="label">Applicant Name:</span>
            <span class="value">{{ $userName }}</span>
        </div>

        <div class="info-row">
            <span class="label">Application Type:</span>
            <span class="value">{{ $applicationType }}</span>
        </div>

        <div class="info-row">
            <span class="label">Transaction ID:</span>
            <span class="value">{{ $transactionId }}</span>
        </div>

        <div class="info-row">
            <span class="label">Submitted At:</span>
            <span class="value">{{ $submittedAt }}</span>
        </div>

        <div class="alert">
            <p style="margin: 0;"><strong>📎 Attachment:</strong> Complete application data is attached as a JSON file.</p>
        </div>
    </div>

    <div class="footer">
        <p>This is an automated notification from the Visa Application System.</p>
        <p>Please log in to the admin panel to review the application.</p>
    </div>
</body>
</html>