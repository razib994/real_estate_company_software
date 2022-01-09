@extends('backend.layouts.master')
@section('title')
    Contact Person Update - - {{ $contacts->person_name }}
@endsection
@section('content')
    <div class="container-fluid">
        @if (Session::has('message'))
            <div class="alert alert-success">
                <div>
                    <p>{{ Session::get('message') }}</p>
                </div>
            </div>
    @endif
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">  Edit Contact Person </h1>
            @if(Auth::guard('admin')->user()->can('category.view'))
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> All Profession </a>
            @endif

        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Contact Person - {{  $contacts->person_name }} </h6>
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
                <form action="{{route('contacts.update', $contacts->id)}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="person_name" class="col-sm-3 col-form-label"> Contact Person Name</label>
                        <div class="col-sm-6">
                            <input type="text"  class="form-control" value="{{ $contacts->person_name }}" id="person_name" name="person_name" placeholder="Enter Your Contact Person Name"/>
                        </div>
                    </div>

                        <div class="form-group row">
                            <label for="submits" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" class="btn btn-success" id="update" name="update" value="Update"/>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

@endsection


