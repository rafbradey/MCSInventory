@extends('include.dash_side')
@section('nav-back')
    <h5> 
        @auth
        Account: {{auth()->user()->name}} (ID: {{auth()->user()->id}})
        @endauth
    </h5>
@endsection
@section('title', 'Damage Reports')
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
        <div class="col-md-10 offset-md-1"> 
            <h3 class="text-center mt-2">Existing Damage Reports</h3>
            <div class="table-responsive"> 
                <table class="table table-striped etable text-center">
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Date Reported</th>
                            <th>Status</th>
                            @if(auth()->user()->usertype == "admin")
                            <th>Actions</th>
                            @endif                     
                        </tr>
                    </thead>   
                    
                    <tbody>
                        @foreach($reports as $report)
                          @if($report->status == 'unresolved')

                            <td>{{ $report->id }}</td>
                            <td>{{ $report->item_name }}</td>
                            <td>{{ $report->description }}</td>
                            <td>{{ $report->location }}</td>
                            <td>{{ $report->date_reported }}</td>
                            <td>
                                @if($report->status =='unresolved')
                                {{$report->status}}
                                @endif
                            @if(auth()->user()->usertype == "admin")
                            <td>
                                <a href="{{url('markasResolved/'.$report->id)}}" class="btn-submit"><i class="fa-solid fa-check"></i></a>
                                <a href="{{url('deleteReport/'.$report->id)}}" class="btn-submit btndelete" onclick="return confirm('Are you sure you want to delete this report?')"><i class="fa-solid fa-trash"></i></a>

                            </td>
                            @endif
                        @endif

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
           
            <h3 class="text-center mt-5">Report Damaged Item</h3>
        
            <form action="{{url('submitReport')}}"  method="post">
                @csrf
            @method('put')
                <div class="mb-3">
                    <label for="item_name" class="form-label">Item Name</label>
                    <input type="text" class="form-control" id="item_name" name="item_name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description of Damage</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
                
                <button class="btn btn-submit d-block mx-auto">Submit Report</button>
                </form>
                </a>
            </form>
        </div>
    </div>

        <div class="row">
            <div class="col-md-10 offset-md-1"> <br><br>
                <h3 class="text-center mt-2">Damage Report Record</h3>
                <div class="table-responsive"> 
                    <table class="table table-striped etable text-center">
                        <thead>
                            <tr>
                                <th>Report ID</th>
                                <th>Item Name</th>
                                <th>Description</th>
                                <th>Location</th>
                                <th>Date Reported</th>
                                <th>Status</th>
                            @if (auth()->user()->usertype == "admin")
                                <th>Actions</th>
                            </tr>
                            @endif
                        </thead>   
                        
                        <tbody>
                         @foreach($reports as $report)
                            @if($report->status == 'resolved')
                            <tr>
                                <td>{{ $report->id }}</td>
                                <td>{{ $report->item_name }}</td>
                                <td>{{ $report->description }}</td>
                                <td>{{ $report->location }}</td>
                                <td>{{ $report->date_reported }}</td>
                                <td>
                                    @if($report->status =='resolved')
                                    {{$report->status}}
                                </td>
                                 @endif
                            @if(auth()->user()->usertype == "admin")
                            <td>
                                <a href="{{ url('deleteReport/'.$report->id) }}" class="btn-submit btndelete" onclick="return confirm('Are you sure you want to delete this report record?')">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                                @endif
                            @endif
 
                            </tr>
                         @endforeach
                        </tbody>
                    </table>
          


</div>
















@endsection
