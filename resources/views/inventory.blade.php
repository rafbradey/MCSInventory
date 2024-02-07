@extends('include.dash_side')
@section('title', 'Inventory')
@section('nav-back')
<h5> 
    @auth
    Account: {{auth()->user()->name}} (ID: {{auth()->user()->id}})
    @endauth
</h5>
@endsection
@section('content')

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

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-6">
      <form action="{{ route('inventory') }}" method="GET" class="d-inline-flex">
          <div class="col">
              <input type="search" name="query" class="form-control" placeholder="Search Inventory">
          </div>
          
          <div class="col-auto mx-2">
              <select name="filter" class="form-select">
                  <option value="">All</option>
                  <option value="id">ID</option>
                  <option value="school_property">School Property</option>
                  <option value="remarks">Remarks</option>
                  <option value="category">Category</option>
                  <option value="acquisition_type">Acquisition Type</option>
                  <option value="grade_level">Grade Level</option>
              </select>
          </div>
          <div class="col-auto">
              <button type="submit" class="btn btn-primary">Search</button>
          </div>
      </form>
    </div>

    <div class="col-lg-6 text-lg-end mt-2 mt-lg-0">
      @if(auth()->user()->usertype != 'user')
          <a href="{{ url('/addItem') }}" class="btn btn-success mx-2">+ Add Item into Inventory</a>
      @endif
  </div>

  </div>
</div>

<div class="table-responsive">
  <table class="content-table">
    <table class="content-table">

      <thead>
        <tr>
          <th>Item Number</th>
          <th>School Property</th>
          <th>Property Number</th>
          <th>Unit of Measure</th>
          <th>Unit Value</th>
          <th>Quantity Per Property Card</th>
          <th>Quantity Per Physical Count</th>
          <th>Quantity</th>
          <th>Value</th>
          <th>Total Value</th>
          <th>Remarks</th>
          <th>Category</th>
          <th>Acquisition Type</th>
          <th>Grade Level</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        
        @if (count($Inventory) > 0)
        @foreach($Inventory as $item)
        <tr id="Inventory_{{ $item->id }}">
          <td>{{ $item->id }}</td>
          <td class="scrollable">{{ $item->school_property }}</td>
          <td>{{ $item->property_number }}</td>
          <td>{{ $item->unit_of_measure }}</td>
          <td>{{ $item->unit_value }}</td>
          <td>{{ $item->quantity_per_property }}</td>
          <td>{{ $item->quantity_per_physical }}</td>
          <td>{{ $item->quantity }}</td>
          <td>{{ $item->value }}</td>
          <td>{{ $item->total_value }}</td>
          <td>{{ $item->remarks }}</td>
          <td>{{ $item->category }}</td>
          <td>{{ $item->acquisition_type }}</td>
          <td>{{ $item->grade_level }}</td>
          <td>
            @if(auth()->user()->usertype === 'admin')
            <div class="btn-group" role="group">
              <a href="{{url('editInventory/'.$item->id)}}" class="btn btn-sm btn-primary mr-1 mx-1">Edit</a>
              <form action="#" method="POST" class="d-inline">
                @csrf
                <a href="{{url('removeConfirm/'.$item->id)}}" class="btn btn-sm btn-danger mx-1">Delete</a>
              </form>
            </div>
            @else

            <form action="{{ url('requestDetails/'.$item->id) }}" method="GET" class="d-inline">       
              <button type="submit" class="btn btn-sm btn-success">Request</button>
          </form>

        @endif
          </td>
        </tr>
        @endforeach
        <tr class="text-end">
          <td colspan="15"> Showing {{$Inventory->firstItem()}} to {{$Inventory->lastItem()}} of {{$Inventory->total()}} entries</td>
        </tr>
        @else
        <tr>
          <td colspan="15">No items found</td>
        </tr>
        <tr>
          <td colspan="15"> Showing {{$Inventory->firstItem()}} to {{$Inventory->lastItem()}} of {{$Inventory->total()}} entries</td>
        </tr>
        @endif
      </tbody>
    </table>
  </table>
</div>

<div class="pagination-container">
  {{$Inventory->appends(request()->input())->links()}}
</div>

@endsection
