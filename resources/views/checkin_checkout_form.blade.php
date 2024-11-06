@extends('layouts.app-master')
@section('pageTitle', "Confirm Check In and Check Out")
@section('content')
    <div class="card-body">
        <div class="info-section">
            <h4><strong style="color: #0000ff;">Owner Name:</strong> {{ $reservation->owner_name }}</h4>
            <h4><strong style="color: #0000ff;">Pet:</strong> {{ $reservation->pet_name }}</h4>
            <h4><strong style="color: #0000ff;">Service:</strong> {{ $reservation->package_details }}</h4>
        </div>
        <br>
        <div>
        <form action="{{ route('checkin-checkout.submit', $reservation->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="indate">Start Date:</label>
                <input type="date" id="indate" name="indate" class="form-control" value="{{ $reservation->indate }}" required>
            </div>
            <div class="form-group">
                <label for="outdate">End Date:</label>
                <input type="date" id="outdate" name="outdate" class="form-control" value="{{ $reservation->outdate }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="notconfirmed" {{ $reservation->status == 'notconfirmed' ? 'selected' : '' }}>Not Confirmed</option>
                </select>
            </div>

            <button type="submit" class="btn btn-dark">
                Save
            </button>
        </form>
        </div>
    </div>
@endsection
