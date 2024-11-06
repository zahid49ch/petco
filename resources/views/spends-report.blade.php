@extends('layouts.app-master')
@section('pageTitle', "Spends Report")
@section('content')
        <div class="card shadow-sm">
            <div class="card-header bg-medium text-white">
                <h3 class="mb-0">Spends Report</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('spends-report.generate') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="start_date">Start Date:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="end_date">End Date:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark">Generate Report</button>
                </form>

                @if(isset($spends) && count($spends) > 0)
                    <div class="mt-4">
                        <h4 class="mb-4">Report Data</h4>
                        <div class="mb-4">
                            <a href="{{ route('spends-report.export-csv', request()->all()) }}" class="btn btn-success mr-2">Download CSV</a>
                            <a href="{{ route('spends-report.export-pdf', request()->all()) }}" class="btn btn-danger">Download PDF</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="thead-dark">
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
                                <tfoot class="thead-light">
                                    <tr>
                                        <td colspan="2" class="text-right font-weight-bold">Total Amount:</td>
                                        <td>${{ number_format($totalAmount, 2) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                @else
                    @if(isset($spends))
                        <div class="alert alert-info mt-4 text-center" role="alert">
                            No records found for the selected period.
                        </div>
                    @endif
                @endif
            </div>
        </div>
@endsection
