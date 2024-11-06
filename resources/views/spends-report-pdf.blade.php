@extends('layouts.app-master')
@section('pageTitle', "Client Report")
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spends Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <h1>Spends Report</h1>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($spends as $spend)
                <tr>
                    <td>{{ $spend->check_in_date }}</td>
                    <td>{{ $spend->description }}</td>
                    <td>${{ number_format($spend->amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="text-align: right;"><strong>Total Amount</strong></td>
                <td><strong>${{ number_format($totalAmount, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
@endsection
