@extends('include.dash_side')

@section('nav-back')
    <a class="nav-link" href="{{ route('inventory') }}" 
    onclick="return confirm('Are you sure you want to return to the previous page? All the changes that you have made WILL NOT BE SAVED')">
        < Back
    </a>

@endsection
@section('title')
    Edit Inventory
@endsection

@section('content')

<div class="container mt-4">
    <h2 class="text-center">Requesting an Item</h2>
    <p class="text-center">Request details for ID: {{$Inventory->id}} - {{ $Inventory->school_property }}</p>

    @if($errors->any())
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
        <div>{{$error}}</div>
        @endforeach
    </div>
    @endif

    @if(session()->has('error'))
    <div class="alert alert-danger">{{session()->get('error')}}</div>
    @endif

    @if(session()->has('success'))
    <div class="alert alert-success">{{session()->get('success')}}</div>
    @endif





    <form action="{{ route('addRequest') }}" method="POST" class="mx-auto">
        @csrf
   
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="id" class="form-label">User</label>
                    <input type="text" class="form-control bg-secondary"" id="user_id" name="user_id" value="{{ auth()->id() }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="id" class="form-label">Item ID</label>
                    <input type="text" class="form-control bg-secondary"" id="inventory_id" name="inventory_id" value="{{ $Inventory->id }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="school_property" class="form-label">School Property</label>
                    <input type="text" class="form-control bg-secondary""" id="school_property" name="school_property" value="{{ $Inventory->school_property }} " readonly>
                </div>

                <div class="mb-3">
                    <label for="property_number" class="form-label">Property Number</label>
                    <input type="text" class="form-control bg-secondary"" id="property_number" name="property_number" value="{{ $Inventory->property_number }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="unit_of_measure" class="form-label">Unit of Measure</label>
                    <input type="text" class="form-control bg-secondary"" id="unit_of_measure" name="unit_of_measure" value="{{ $Inventory->unit_of_measure }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="unit_value" class="form-label">Unit Value</label>
                    <input type="text" class="form-control" id="unit_value" name="unit_value" value="{{ $Inventory->unit_value }}" >
                </div>

                <div class="mb-3">
                    <label for="quantity_per_property" class="form-label">Quantity per Property</label>
                    <input type="text" class="form-control" id="quantity_per_property" name="quantity_per_property" value="{{ $Inventory->quantity_per_property }}">
                </div>

                <div class="mb-3">
                    <label for="quantity_per_physical" class="form-label">Quantity per Physical</label>
                    <input type="text" class="form-control" id="quantity_per_physical" name="quantity_per_physical" value="{{ $Inventory->quantity_per_physical }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $Inventory->quantity }}">
                </div>

                <div class="mb-3">
                    <label for="value" class="form-label">Value</label>
                    <input type="text" class="form-control" id="value" name="value" value="{{ $Inventory->value }}">
                </div>

                <div class="mb-3">
                    <label for="total_value" class="form-label">Total Value</label>
                    <input type="text" class="form-control" id="total_value" name="total_value" value="{{ $Inventory->total_value }}">
                </div>

                <div class="mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <input type="text" class="form-control bg-secondary"" id="remarks" name="remarks" value="{{ $Inventory->remarks }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control bg-secondary"" id="category" name="category" value="{{ $Inventory->category }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="acquisition_type" class="form-label">Acquisition Type</label>
                    <input type="text" class="form-control bg-secondary"" id="acquisition_type" name="acquisition_type" value="{{ $Inventory->acquisition_type }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="grade_level" class="form-label">Grade Level</label>
                    <input type="text" class="form-control bg-secondary" id="grade_level" name="grade_level" value="{{ $Inventory->grade_level }} " readonly>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-4 text-center">
                <a class="btn btn-danger btn-md my-4 mx-2" href="{{ url('requests') }}" > Cancel</a>
                <button type="submit" class="btn btn-primary btn-md my-4 mx-2">Request</button>
            </div>
        </div>
    </form>
</div>
@endsection
