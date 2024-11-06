@extends('layouts.app-master')

@section('pageTitle', "Update Confirmation")

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-medium text-white">
            <h3 class="mb-0">Update Confirmation</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Owner Name</th>
                            <th>Email</th>
                            <th>Service</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Pet Name</th>
                            <th>Phone No</th>
                            <th>Date In</th>
                            <th>Date Out</th>
                            <th>Pet Behavior</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->id }}</td>
                                <td>{{ $reservation->owner_name }}</td>
                                <td>{{ $reservation->email }}</td>
                                <td>{{ $reservation->package_details }}</td>
                                <td>{{ $reservation->payment_status }}</td>
                                <td>
                                    <span class="badge bg-{{ $reservation->status == 'confirmed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </td>

                                <td>{{ $reservation->pet_name }}</td>
                                <td>{{ $reservation->phone_no }}</td>
                                <td>{{ $reservation->indate }}</td>
                                <td>{{ $reservation->outdate }}</td>
                                <td>{{ $reservation->pet_behavior }}</td>
                                <td>
                                    <a href="{{ route('checkin-checkout.form', $reservation->id) }}" class="btn btn-info btn-sm">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">No bookings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
