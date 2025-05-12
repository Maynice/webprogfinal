<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Additional Document Request</title>
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
        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #e7ce92;
            color: #002147 !important;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
            border: none;
        }
        a.button:hover {
            background-color: #e7a711;
        }
        .footer {
            text-align: center;
            font-size: 0.8em;
            color: #cccccc; 
            margin-top: 20px;
        }

        blockquote {
            border-left: 4px solid #eee;
            padding-left: 15px;
            margin-left: 0;
            margin-right: 0;
            font-style: italic;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="form-container">
            <div class="form-header">
                Request for Additional Information/Document
            </div>

            <p>Dear <strong>{{ $applicantName }}</strong>,</p>

            <p>Regarding your submission (ID: <strong>{{ $submissionId }}</strong>), the reviewer requires additional information or documentation.</p>

            <p>Details provided by the reviewer ({{ $reviewerName }}):</p>
            <blockquote>
                {{-- nl2br to preserve line breaks from the input --}}
                {!! nl2br(e($requestInfo)) !!}
            </blockquote>

            <p>Please upload the requested document(s) or provide the information as soon as possible through the application portal.</p>

            {{-- still use default dashboard link --}}
            <p style="text-align: center; margin-top: 25px; margin-bottom: 25px;">
                <a href="http://127.0.0.1:8000/dashboard.html" class="button">Go to Application Portal</a>
            </p>


            <p>If you have any questions about this request, please contact us by replying to this email or through the support section of the portal.</p>

            <p>Thank you,<br>
            {{ config('app.name') }}
            </p>

        </div>

        <div class="footer">
            You are receiving this email regarding your submission (ID: {{ $submissionId }}) to {{ config('app.name') }}.
        </div>
    </div>
</body>
</html>
