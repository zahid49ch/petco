@extends('layouts.app-master')
@section('pageTitle', "Grooming Tracking")
@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-medium text-white">
            <h3 class="mb-0">Update Grooming Tracking</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('update.tracking') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="owner_id">Owner ID</label>
                    <select name="owner_id" id="owner_id" class="form-control">
                        <option value="">Select OwnerID</option>
                        @foreach($dogs as $dog)
                            <option value="{{ $dog->id }}">{{ $dog->id }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="step">Grooming Step</label>
                    <select name="step" id="step" class="form-control">
                        <option value="">Select Step</option>
                        <option value="Step1">Step1: name1</option>
                        <option value="Step2">Step2: name2</option>
                        <option value="Step3">Step3: name3</option>
                        <option value="Step4">Step4: name4</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-dark w-100">Update</button>
            </form>
        </div>
    </div>
@endsection
