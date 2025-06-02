<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Ticket Sales Report - Santiago Bernabeu</title>
    <style>
        @page {
            margin: 40px 40px 70px 40px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background: #fff;
        }
        
        /* Header */
        header {
            display: flex;
            align-items: center;
            border-bottom: 4px solid rgb(26, 62, 98);
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        header img {
            height: 50px;
            margin-right: 15px;
        }
        header h1 {
            font-size: 28px;
            color: rgb(26, 62, 98);
            margin: 0;
            font-weight: 700;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Footer */
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40px;
            border-top: 2px solid rgb(26, 62, 98);
            color: #666;
            font-size: 12px;
            text-align: center;
            padding-top: 10px;
            font-style: italic;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: white;
            color: rgb(26, 62, 98);
            font-weight: 600;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Section titles */
        h2 {
            color:rgb(26, 62, 98);
            font-weight: 700;
            margin-bottom: 10px;
            border-bottom: 2px solid rgb(26, 62, 98);
            padding-bottom: 3px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        p.description {
            font-size: 14px;
            color: #555;
            margin-top: -15px;
            margin-bottom: 25px;
            font-style: italic;
        }
    </style>
</head>
<body>

<header>
    <img src="{{ public_path('images/picture.jpg') }}" alt="Santiago Bernabeu Logo" />
    <h1>Santiago Bernabeu</h1>
</header>

<p class="description">Ticket Sales Report — Revenue analytics and performance metrics</p>

<h2>Summary</h2>
<table>
    <tr>
        <th>Category</th>
        <th>Tickets Sold</th>
        <th>Revenue (TZS)</th>
    </tr>
    <tr>
        <td>VIP Tickets</td>
        <td>{{ $vipTicketsCount }}</td>
        <td>{{ number_format($vipRevenue) }}</td>
    </tr>
    <tr>
        <td>General Tickets</td>
        <td>{{ $generalTicketsCount }}</td>
        <td>{{ number_format($generalRevenue) }}</td>
    </tr>
    <tr>
        <th>Total</th>
        <th>{{ $vipTicketsCount + $generalTicketsCount }}</th>
        <th>{{ number_format($totalRevenue) }}</th>
    </tr>
</table>

<h2>Daily Profit Details</h2>
<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>VIP Ticket Revenue (TZS)</th>
            <th>General Ticket Revenue (TZS)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dailyProfits as $day)
            <tr>
                <td>{{ $day['date'] }}</td>
                <td>{{ number_format($day['vip_amount']) }}</td>
                <td>{{ number_format($day['general_amount']) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<footer>
    &copy; {{ date('Y') }} Santiago Bernabeu Stadium. All rights reserved.
</footer>

</body>
</html>
