@extends('layouts.app-master')
@section('pageTitle', "Client Report")
@section('content')
        <div class="card shadow-sm">
            <div class="card-header bg-medium custom-text-white">
                <h3 class="mb-0">Client Report</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('client-report.form') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="start-date">Start Date:</label>
                            <input type="date" id="start-date" name="start_date" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="end-date">End Date:</label>
                            <input type="date" id="end-date" name="end_date" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark">
                        Generate Report
                    </button>
                </form>
            </div>
        </div>

        @if(isset($reportData) && count($reportData) > 0)
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="mb-4">Report from {{ $date_from }} to {{ $date_to }}</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Owner Name</th>
                                    <th>Email</th>
                                    <th>Pet</th>
                                    <th>Pet Details</th>
                                    <th>Pet Dirthday</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reportData as $dog)
                                <tr>
                                    <td>{{ $dog->id }}</td>
                                    <td>{{ $dog->ownername }}</td>
                                    <td>{{ $dog->email  }}</td>
                                    <td>{{ $dog->dogname }}</td>
                                    <td>{{ $dog->dogdetail }}</td>
                                    <td>{{ $dog->dogbirthday }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Export Buttons -->
                    <div class="export-buttons mt-3">
                        <form action="{{ route('client-report.export-csv') }}" method="GET" style="display:inline;">
                            <input type="hidden" name="start_date" value="{{ $date_from }}">
                            <input type="hidden" name="end_date" value="{{ $date_to }}">
                            <button type="submit" class="btn btn-success">Download CSV</button>
                        </form>
                        <form action="{{ route('client-report.export-pdf') }}" method="GET" style="display:inline;">
                            <input type="hidden" name="start_date" value="{{ $date_from }}">
                            <input type="hidden" name="end_date" value="{{ $date_to }}">
                            <button type="submit" class="btn btn-danger">Download PDF</button>
                        </form>
                    </div>
                </div>
            </div>
        @elseif(isset($date_from) && isset($date_to))
            <div class="alert alert-info mt-4" role="alert">
                No data available for the selected date range.
            </div>
        @endif
@endsection
