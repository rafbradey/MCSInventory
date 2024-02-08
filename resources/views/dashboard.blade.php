@extends('include.dash_side')
@section('nav-back')
<h5> 
        @auth
        Account: {{auth()->user()->name}} (ID: {{auth()->user()->id}})
        @endauth
</h5>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-1">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Inventory Summary</h3>
                    @if(auth()->user()->usertype === 'admin')
                    <a href = "{{url('/addItem')}}"class="btn btn-warning mr-2"> <i class="fa-solid fa-plus"></i></a>
                    @elseif (auth()->user()->usertype != 'admin')
                    @endif
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-4">
                            <div class="card inventory-box mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">{{$totalQuantity}}</h5>
                                    <p class="card-text">Overall School Inventory Item Quantity</p>
                                </div>
                            </div>
                        </div>
                        

                        <div class="col-md-4">
                            <div class="card inventory-box mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">{{$totalGCQ}}</h5>
                                    <p class="card-text">Items in Good Condition</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card inventory-box mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">{{$PendingRequests}}</h5>
                                    <p class="card-text">Pending User Requests</p>                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card inventory-box mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">{{$numberofUsers}}</h5>
                                    <p class="card-text">Number of Site Users</p>                    
                                </div>
                            </div>
                        </div>


             <div class="col-md-4">
                            <div class="card inventory-box mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">{{$UnresolvedReports}}</h5>
                                    <p class="card-text">Unresolved Reports</p>                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card inventory-box mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">{{$PendingRequests}}</h5>
                                    <p class="card-text">Pending User Requests</p>                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
        <h3 class="mt-4 mt-1">Recent Requests</h3>
    </div>
        <div class="container d-flex justify-content-center align-items-center"">
            <div class = "col-md-12">
          <div class="table-container">
                    <table class="etable text-center">
    <thead>
        <tr>
            <th scope="col">Request ID</th>
            <th scope="col">User Name</th>
            <th scope="col">Requested Item</th>
            <th scope="col">Quantity</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @php $counter = 0; @endphp
        @foreach($userRequests as $request)
            @if($request->status === 'pending')
                @if($counter < 3)
                    <tr id="UserRequest_{{ $request->id }}">
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->user->name }}</td>
                        <td>{{ $request->school_property }}</td>
                        <td>{{ $request->quantity }}</td>
                        <td>{{ $request->status }}</td>
                        <td>
                            @if(auth()->user()->usertype !== 'admin' && $request->user_id === auth()->user()->id)
                                <form action="#" method="POST" class="d-inline">
                                    @csrf
                                    <a href="{{ url('declineRequest/'.$request->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel the request of {{ $request->user->name }}')">Cancel Request</a>
                                </form>
                            @elseif(auth()->user()->usertype === 'admin')
                                <a href="{{ url('acceptRequest/'.$request->id) }}" class="btn btn-primary" onclick="return confirm('Are you sure you want to Accept the request of {{ $request->user->name }}')">Accept</a>
                                <a href="{{ url('declineRequest/'.$request->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to Decline the request of {{ $request->user->name }}')">Decline</a>
                            @endif
                        </td>
                    </tr>
                    @php $counter++; @endphp
                @else
                    @break
                @endif
            @endif
        @endforeach
    </tbody>
                    </table>
                </div>


    </div> 
</div>



@endsection



