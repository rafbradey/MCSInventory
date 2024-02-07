@extends('include.dash_side')

@section('nav-back')
    <a class="nav-link" href="{{ route('inventory') }}" 
    onclick="return confirm('Are you sure you want to return to the previous page? All the changes that you have made WILL NOT BE SAVED')">
        < Back
    </a>
@endsection

@section('content')

<div class="container mt-4">
    <h2 class="text-center">Cancel Request</h2>
    <p class="text-center">Confirm deletion for ID: {{$UserRequests->inventory_id}} - {{ $UserRequests->school_property }}</p>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="id" class="form-label">Item ID</label>
                <input type="text" class="form-control" id="id" name="id" value="{{ $UserRequests->id }}" readonly>
            </div>

            <div class="mb-3">
                <label for="school_property" class="form-label">School Property</label>
                <input type="text" class="form-control" id="school_property" name="school_property" value="{{ $UserRequests->school_property }}" readonly>
            </div>

            <div class="mb-3">
                <label for="property_number" class="form-label">Property Number</label>
                <input type="text" class="form-control" id="property_number" name="property_number" value="{{ $UserRequests->property_number }}" readonly>
            </div>

            <div class="mb-3">
                <label for="unit_of_measure" class="form-label">Unit of Measure</label>
                <input type="text" class="form-control" id="unit_of_measure" name="unit_of_measure" value="{{ $UserRequests->unit_of_measure }}" readonly>
            </div>

            <div class="mb-3">
                <label for="unit_value" class="form-label">Unit Value</label>
                <input type="text" class="form-control" id="unit_value" name="unit_value" value="{{ $UserRequests->unit_value }}" readonly>
            </div>

            <div class="mb-3">
                <label for="quantity_per_property" class="form-label">Quantity per Property</label>
                <input type="text" class="form-control" id="quantity_per_property" name="quantity_per_property" value="{{ $UserRequests->quantity_per_property }}" readonly>
            </div>

            <div class="mb-3">
                <label for="quantity_per_physical" class="form-label">Quantity per Physical</label>
                <input type="text" class="form-control" id="quantity_per_physical" name="quantity_per_physical" value="{{ $UserRequests->quantity_per_physical }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $UserRequests->quantity }}" readonly>
            </div>

            <div class="mb-3">
                <label for="value" class="form-label">Value</label>
                <input type="text" class="form-control" id="value" name="value" value="{{ $UserRequests->value }}" readonly>
            </div>

            <div class="mb-3">
                <label for="total_value" class="form-label">Total Value</label>
                <input type="text" class="form-control" id="total_value" name="total_value" value="{{ $UserRequests->total_value }}" readonly>
            </div>

            <div class="mb-3">
                <label for="remarks" class="form-label">Remarks</label>
                <input type="text" class="form-control" id="remarks" name="remarks" value="{{ $UserRequests->remarks }}" readonly>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ $UserRequests->category }}" readonly>
            </div>

            <div class="mb-3">
                <label for="acquisition_type" class="form-label">Acquisition Type</label>
                <input type="text" class="form-control" id="acquisition_type" name="acquisition_type" value="{{ $UserRequests->acquisition_type }}" readonly>
            </div>

            <div class="mb-3">
                <label for="grade_level" class="form-label">Grade Level</label>
                <input type="text" class="form-control" id="grade_level" name="grade_level" value="{{ $UserRequests->grade_level }}" readonly>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-4 mx-auto text-center">
            <a class="btn btn-secondary" href="{{ route('inventory') }}">Cancel</a>
        </div>
        <div class="col-md-4 mx-auto text-center">
            <a href="{{url('deleteInventory/'. $UserRequests->id}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this inventory item?')">Delete</a>
        </div>
    </div>
</div>

@endsection
