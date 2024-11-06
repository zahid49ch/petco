@extends('layouts.app-master')
@section('pageTitle', "Send Notification")
@section('content')
        <div class="card shadow-sm">
            <div class="card-header bg-medium text-white">
                <h3 class="mb-0">Send Notifications</h3>
            </div>
            <div class="card-body">
                {{-- Display success message --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Display error message --}}
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ route('notification.send') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea id="message" name="message" class="form-control @error('message') is-invalid @enderror" rows="6" placeholder="Enter your message here">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="owner" class="form-label">To Email</label>
                        <select id="owner" name="owner" class="form-select @error('owner') is-invalid @enderror">
                            <option value="" disabled selected>Select the Email</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('owner') == $user->id ? 'selected' : '' }}>
                                    {{ $user->email }}
                                </option>
                            @endforeach
                        </select>
                        @error('owner')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-dark w-100">
                        Send Notification
                    </button>
                </form>
            </div>
        </div>
@endsection
