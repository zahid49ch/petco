@extends('layouts.app-master')
@section('pageTitle', "Create Spend Record")
@section('content')
        <div class="card shadow-sm">
            <div class="card-header bg-medium text-white">
                <h4 class="mb-0">Create Spend Record</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('spends.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="check_in_date" class="form-label">Date of Check-In</label>
                        <input type="date" id="check_in_date" name="check_in_date" class="form-control @error('check_in_date') is-invalid @enderror" required>
                        @error('check_in_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" id="description" name="description" class="form-control @error('description') is-invalid @enderror" required>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" id="amount" name="amount" class="form-control @error('amount') is-invalid @enderror" step="0.01" required>
                        @error('amount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-dark w-100">Save Record</button>
                </form>
            </div>
        </div>
@endsection
