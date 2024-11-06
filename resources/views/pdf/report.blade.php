<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <h2>Client Report from {{ $date_from }} to {{ $date_to }}</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Owner</th>
                <th>Pet</th>
                <th>Phone</th>
                <th>Pet Behavior</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reportData as $dog)
            <tr>
                <td>{{ $dog->id }}</td>
                <td>{{ $dog->owner_name }}</td>
                <td>{{ $dog->pet_name }}</td>
                <td>{{ $dog->phone_no }}</td>
                <td>{{ $dog->pet_behavior }}</td>
                <td>{{ $dog->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
