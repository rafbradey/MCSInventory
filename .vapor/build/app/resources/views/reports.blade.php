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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-1"> 
            <h3 class="text-center mt-2">Existing Damage Reports</h3>
            <div class="table-responsive"> 
                <table class="table table-striped etable">
                    <thead>
                        <tr>
                            <th>Report ID</th>
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Date Reported</th>
                            @if(auth()->user()->usertype == "admin")
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>   
                    
                    <tbody>
                        @foreach($reports as $report)
                        <tr>
                            <td>{{ $report->id }}</td>
                            <td>{{ $report->item_name }}</td>
                            <td>{{ $report->description }}</td>
                            <td>{{ $report->location }}</td>
                            <td>{{ $report->date_reported }}</td>
                            @if(auth()->user()->usertype == "admin")
                            <td>
                                <a href="#" class="btn-submit"><i class="fa-solid fa-check"></i></a>
                                <a href="#" class="btn-submit"><i class="fa-solid fa-x"></i></a>
                            </td>

                        
                       
                
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
</div>

<style>
    .container {
        padding-top: 30px;
    }
    .btn-submit {
        background-color: #009879;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .btn-submit:hover {
        background-color: #007564;
    }
    .damage-table {
        margin-top: 50px;
    }
    .damage-table th {
        background-color: #009879;
        color: white;
    }
  
    .form-control {
        border: 1px solid #009879;
        width: 100%;
    }

    .etable {
        width: 100%;
    }

    .text-center {
    text-align: center;
}


.text-center {
    text-align: center;
}



</style>

@endsection
