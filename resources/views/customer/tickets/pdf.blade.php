<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SantiagoBernabeu Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .ticket-container {
            border: 1px solid #000;
            padding: 15px;
            width: 300px;
            margin: 20px auto;
            position: relative;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #ccc;
        }

        .header img {
            width: 60px;
            height: auto;
        }

        .header h1 {
            margin: 5px 0;
            font-size: 18px;
            color: #1a202c;
        }

        .section {
            margin-top: 15px;
        }

        .section h2 {
            font-size: 14px;
            border-bottom: 1px solid #ccc;
            margin-bottom: 8px;
            padding-bottom: 3px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .info-table td {
            padding: 5px;
            vertical-align: top;
        }

        .label {
            font-weight: bold;
            width: 100px;
        }

        .code {
            font-family: 'Courier New', monospace;
            font-size: 14px;
            letter-spacing: 2px;
            color: #d00;
            font-weight: bold;
            margin-top: 15px;
            text-align: center;
            padding: 8px;
            background-color: #fff;
            border: 1px dashed #000;
        }

        .venue {
            text-align: center;
            font-style: italic;
            margin: 10px 0;
            font-size: 11px;
        }

        .barcode {
            text-align: center;
            margin-top: 10px;
            font-family: 'Libre Barcode 39', cursive;
            font-size: 36px;
        }

        .disclaimer {
            font-size: 9px;
            text-align: center;
            margin-top: 15px;
            color: #666;
        }

        .perforation {
            border-top: 1px dashed #999;
            margin: 10px 0;
            position: relative;
        }

        .perforation:before {
            content: "••••••••••••••••••••••••••••••••••••••••";
            letter-spacing: 3px;
            color: #999;
            position: absolute;
            top: -10px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+39&display=swap" rel="stylesheet">
</head>
<body>
    <div class="ticket-container">
        <div class="header">
            <img src="{{ public_path('images/picture.jpg') }}" alt="Santiago Logo">
            <h1>SANTIAGO BERNABEU STADIUM</h1>
        </div>

        <div class="venue">
            Bernabeu Hall 
        </div>

        <div class="section">
            <table class="info-table">
                <tr>
                    <td class="label">Visitor:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td class="label">Event:</td>
                    <td>Match</td>
                </tr>
                <tr>
                    <td class="label">Date:</td>
                    <td>{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                </tr>
                <tr>
                    <td class="label">Ticket Class:</td>
                    <td>{{ $class }}</td>
                </tr>
                <tr>
                    <td class="label">Price:</td>
                    <td>{{ number_format($price, 0) }} TZS</td>
                </tr>
            </table>
        </div>

        <div class="perforation"></div>

        <div class="code">
            {{ $ticket->ticket_code }}
        </div>

        <div class="barcode">
            ---{{ $ticket->ticket_code }}---
        </div>

        <div class="disclaimer">
            This ticket must be presented for entry. No re-entry. Management reserves the right to refuse admission.
        </div>
    </div>
</body>
</html>