@extends('layouts.app-master')
@section('pageTitle', "Revenue Report")
@section('content')
        <div class="card shadow-sm">
            <div class="card-header bg-medium text-white">
                <h3 class="mb-0">Revenue Report</h3>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('hotel_log_report.form') }}">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="start-date">Start Date:</label>
                            <input type="date" id="start-date" name="start_date" class="form-control" value="{{ $startDate }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="end-date">End Date:</label>
                            <input type="date" id="end-date" name="end_date" class="form-control" value="{{ $endDate }}" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark">Generate Report</button>
                </form>

                @if($bookings->isEmpty())
                    <div class="alert alert-info mt-4" role="alert">
                        No bookings found.
                    </div>
                @else
                    <div class="mt-4">
                        <p class="h4 font-weight-bold">Total Revenue: <span class="text-success">${{ number_format($totalRevenue, 2) }}</span></p>
                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Date</th>
                                        <th>Service</th>
                                        <th>Owner</th>
                                        <th>Pet</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bookings as $booking)
                                        <tr>
                                            <td>{{ $booking->booking_date }}</td>
                                            <td>{{ $booking->type }}</td>
                                            <td>{{ $booking->owner_name }}</td>
                                            <td>{{ $booking->pet_name }}</td>
                                            <td>${{ number_format($booking->amount, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
@endsection
