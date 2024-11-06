@extends('layouts.app-master')
@section('pageTitle', "Client Report")
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revenue Report</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            margin-bottom: 20px;
            color: #343a40;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        .form-control {
           width: 100%;
           padding: 10px;
           border: 1px solid #ced4da;
           border-radius: 4px;
           box-sizing: border-box;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table thead th {
            background-color: #343a40;
            color: #fff;
            padding: 10px;
            text-align: left;
        }
        table tbody td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        table tfoot td {
            padding: 10px;
            font-weight: bold;
        }
        table tfoot tr {
            background-color: #f8f9fa;
        }
        .text-center {
            text-align: center;
        }
        .mt-4 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Revenue Report</h1>
        <form action="{{ route('report.generate') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="service">Select Service</label>
                <select id="service" name="service" class="form-control" required>
                    <option value="">Select the Service</option>
                    <option value="all">All Services</option>
                    <option value="hotel">Hotel</option>
                    <option value="grooming">Grooming</option>
                    <option value="daycare">Day Care</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date_from">Select Date From</label>
                <input type="date" id="date_from" name="date_from" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="date_to">Select Date To</label>
                <input type="date" id="date_to" name="date_to" class="form-control" required>
            </div>
            <br>
            <button type="submit" class="btn btn-dark">Generate Report</button>
        </form>

        <!-- Report Table -->
        @if(session('data'))
        <div class="mt-4">
            <h4>Report Data</h4>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Service</th>
                        <th>Owner</th>
                        <th>Pet</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example data, replace with actual data -->
                    <tr>
                        <td>10/08/2024</td>
                        <td>Grooming</td>
                        <td>John Doe</td>
                        <td>Toby</td>
                        <td>$150</td>
                    </tr>
                    <tr>
                        <td>11/08/2024</td>
                        <td>Hotel</td>
                        <td>Noferini</td>
                        <td>Rambo</td>
                        <td>$400</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-center"><strong>Total Amount</strong></td>
                        <td><strong>$550</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        @endif
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
@endsection
