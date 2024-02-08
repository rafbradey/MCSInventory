@extends('include.dash_side')

@section('nav-back')
    <h5>
        @auth
            Account: {{ auth()->user()->name }} (ID: {{ auth()->user()->id }})
        @endauth
    </h5>
@endsection

@section('title', 'Requests')

@section('content')
    <div class="container d-flex justify-content-center align-items-center"">
        <div class = "col-md-12">
            <!-- First table -->
            
            <div class="table-container">
                <table class="etable text-center">
                    <thead>
                        <h2>Pending Requests</h2>
                    </thead>
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
                        @foreach($UserRequests as $request)
                            @if($request->status === 'pending')
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
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Second table -->
            @if(auth()->user()->usertype == 'admin')
                <div class="table-container">
                    <table class="etable text-center">
                        <thead>
                            <h2>Accepted Requests</h2>
                        </thead>
                        <thead>
                            <tr>
                                <th scope="col">Request ID</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Requested Item</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($UserRequests as $request)
                            <form action="{{url('markedAsComplete/'.$request->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                @if($request->status === 'accepted')
                                    <tr scope="row" id="UserRequest_{{ $request->id }}">
                                        <td>{{ $request->id }}</td>
                                        <td>{{ $request->user->name }}</td>
                                        <td>{{ $request->school_property }}</td>
                                        <td>{{ $request->quantity }}</td>
                                        <td class = "text-success">{{ $request->status }}</td>
                                        
                                        <td>
                                            @if(auth()->user()->usertype !== 'admin')
                                            <!--for users-->
                                                    <a href="{{ url('declineRequest/'.$request->id) }}" 
                                                        class="btn btn-danger" onclick="return confirm('Are you sure you want to Decline the request of {{ $request->user->name }}')">Cancel Request</a>
                                                



                                            @elseif(auth()->user()->usertype === 'admin')
                                                <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to Mark this request as completed? {{ $request->school_property }} {{$request->quantity}}{{$request->unit_of_measure}}')">
                                                    Mark as completed</button>
                                               



                                                    <a href="{{ url('cancelledRequest/'.$request->id) }}" 
                                                    class="btn btn-danger" onclick="return confirm('Are you sure you want to CANCEL the request of {{ $request->user->name }}')">Cancel</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </form>
                        </tbody>
                    </table>
                </div>
            @endif
         
            <div class="table-container">
                <table class="etable text-center">
                    <thead>
                        <h2>Completed Request History</h2>
                    </thead>
                    <thead>
                        <tr>
                            <th scope="col">Request ID</th>
                            <th scope="col">Requester Name</th>
                            <th scope="col">Requested Item</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($request_history as $request)
                            @if($request->status === 'completed' || $request->status === 'declined')
                                <tr scope="row" id="request_history_{{ $request->id }}">
                                    <td>{{ $request->id }}</td>
                                    <td>{{ $request->user->name}}</td>
                                    <td>{{ $request->school_property }}</td>
                                    <td>{{ $request->quantity }}</td>
                                    <td class = "text-success">{{ $request->status }}</td>
                                    <td>
                                        @if(auth()->user()->usertype !== 'admin')
                                       
                                                <a href="{{ url('viewRequest/'.$request->id) }}" 
                                                    class="btn btn-secondary">
                                                    View Request</a>
                                         
                                        @elseif(auth()->user()->usertype === 'admin')
                                        <a href="{{ url('viewRequest/'.$request->id) }}" class="btn btn-secondary d-in-line">View Request</a>
                                            <a href="{{ url('deleteRequest/'.$request->id) }}" 
                                                class="btn btn-danger" onclick="return confirm('Are you sure you want to delete history of {{ $request->school_property }} request')">Delete</a>

                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            
      



        </div>
    </div>
@endsection
