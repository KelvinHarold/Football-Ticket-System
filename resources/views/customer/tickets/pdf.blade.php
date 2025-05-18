<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SantiagoBernabeu Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }

        .ticket-container {
            border: 2px dashed #000;
            padding: 30px;
            width: 100%;
        }

        .header {
            text-align: center;
        }

        .header img {
            width: 80px;
            height: auto;
        }

        .header h1 {
            margin: 10px 0;
            font-size: 24px;
            color: #1a202c;
        }

        .section {
            margin-top: 25px;
        }

        .section h2 {
            font-size: 18px;
            border-bottom: 1px solid #ccc;
            margin-bottom: 10px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 8px;
            vertical-align: top;
        }

        .label {
            font-weight: bold;
            width: 160px;
        }

        .code {
            font-size: 18px;
            letter-spacing: 2px;
            color: #1a202c;
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="header">
            <img src="{{ public_path('images/picture.jpg') }}" alt="Santiago Logo">
            <h1>SantiagoBernabeu</h1>
        </div>

        <div class="section">
            <h2>Customer Information</h2>
            <table class="info-table">
                <tr>
                    <td class="label">Name:</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td class="label">Email:</td>
                    <td>{{ $user->email }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h2>Ticket Details</h2>
            <table class="info-table">
                <tr>
                    <td class="label">Ticket Class:</td>
                    <td>{{ $class }}</td>
                </tr>
                <tr>
                    <td class="label">Ticket Code:</td>
                    <td>{{ $ticket->ticket_code }}</td>
                </tr>
                <tr>
                    <td class="label">Amount Paid:</td>
                    <td>{{ number_format($price, 0) }} TZS</td>
                </tr>
                <tr>
                    <td class="label">Payment Method:</td>
                    <td>{{ $transaction->payment_method }}</td>
                </tr>
                <tr>
                    <td class="label">Status:</td>
                    <td>{{ $transaction->payment_status }}</td>
                </tr>
                <tr>
                    <td class="label">Date Booked:</td>
                    <td>{{ $transaction->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            </table>
        </div>

        <p class="code">Your Code: {{ $ticket->ticket_code }}</p>
    </div>
</body>
</html>
