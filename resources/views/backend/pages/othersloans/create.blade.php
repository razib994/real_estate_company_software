@extends('backend.layouts.master')
@section('title')
   Loan Create
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">  Create  Loan </h1>
            @if(Auth::guard('admin')->user()->can('bank.view'))
            <a href="{{ route('othersloans.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> Loan List </a>
                @endif
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Other Create </h6>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{route('othersloans.store')}}" method="post">
                    @csrf

                    <div class="form-group row">
                        <label for="purpose_name" class="col-sm-3 col-form-label">Investor Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="purpose_name" name="purpose_name" placeholder="Enter Your Investor Name"/>
                        </div>
                    </div>

                        <div class="form-group row">
                            <label for="date" class="col-sm-3 col-form-label">Date</label>
                            <div class="col-sm-6">
                                <input type="date" class="form-control" id="date" name="date" placeholder="Enter Your Date"/>
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Your Amount"/>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="submits" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-6">
                            <input type="submit" class="btn btn-primary" id="submits" name="submit" value="Submit"/>
                        </div>
                    </div>
                    </form>
            </div>
        </div>
    </div>

@endsection



