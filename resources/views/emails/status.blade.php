<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status Update</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        body {
            background: #002147;
            min-height: 100vh;
            padding: 20px;
            font-family: sans-serif;
            color: #333; 
            -webkit-font-smoothing: antialiased;
        }

        .email-container { 
             max-width: 1000px; 
             margin: 0 auto;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 12px; 
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 20px;
        }
        .form-header {
            text-align: center;
            font-size: 1.5rem; 
            font-weight: bold;
            color: #cba344;
            margin-bottom: 20px;
        }
        p {
            margin: 0 0 1em 0; 
            line-height: 1.5;
        }
        strong {
             font-weight: bold;
        }

        .status-highlight {
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 4px;
            background-color: #e7ce92;
            color: #333;
        }
        .footer {
            text-align: center;
            font-size: 0.8em;
            color: #cccccc; 
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <div class="email-container">
        <div class="form-container">
            <div class="form-header">
                Application Status Update
            </div>

            <p>Dear <strong>{{ $applicantName }}</strong>,</p>

            <p>This email confirms an update to the status of your application (Submission ID: <strong>{{ $submissionId }}</strong>).</p>

            <p>Your application status has been updated to: <span class="status-highlight">{{ $submissionStatus }}</span>.</p>

            <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">

            <p style="font-size: 0.9em; color: #555;">
                This update was made by: {{ $updatedByName }} ({{ $updatedByEmail }}).
            </p>

            <p>If you have any questions, please reply to this email or contact our support team.</p>

            <p>Thank you,<br>
            {{ config('app.name') }}
            </p>

        </div>

        <div class="footer">
            You are receiving this email because you submitted an application via {{ config('app.name') }}. <br>
            Submission ID: {{ $submissionId }} | Applicant: {{ $applicantEmail }}
        </div>
    </div>
</body>
</html>