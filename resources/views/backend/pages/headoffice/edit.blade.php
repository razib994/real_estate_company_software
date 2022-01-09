@extends('backend.layouts.master')
@section('title')
    Particular Update - - {{ $headoffice->particular_name }}
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
            <h1 class="h3 mb-0 text-gray-800">  Edit Head office Particular</h1>


        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Head office Particular - {{  $headoffice->particular_name }} </h6>
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
                <form action="{{route('update-headoffice-particular')}}" method="post">

                    @csrf
                    <div class="form-group row">
                        <label for="particular_name" class="col-sm-3 col-form-label"> Particular Name</label>
                        <div class="col-sm-6">
                            <input type="hidden"  class="form-control" value="{{ $headoffice->id }}" id="id" name="id" />
                            <input type="text"  class="form-control" value="{{ $headoffice->particular_name }}" id="particular_name" name="particular_name" placeholder="Enter Your particular Name"/>
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


