@extends('backend.layouts.master')
@section('title')
    Head office Particular List
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
            <h1 class="h3 mb-0 text-gray-800">Head office Particular List </h1>
            <a href="{{ route('create-headoffice-particular') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Head office Particular </a>
        </div>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6 mb-2 text-right">
{{--            <a href="{{ url('admin/export-csv-category') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
            <a href="{{ url('admin/export-excel-category') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
            <a href="{{ url('admin/category-pdf') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
{{--            <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
        </div>
    </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Head office Particular List </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Head office Particular Name</th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Sl</th>
                            <th>Head office Particular Name</th>
                            <th width="10%">Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @php
                        $i=1;
                        @endphp
                        @foreach($headoffices as $headoffice)
                        <tr>
                            <td> {{ $i++ }} </td>
                            <td> {{  $headoffice->particular_name}} </td>
                            <td>

                                <form action="{{ route('delete-headoffice-particular', $headoffice->id)}}" method="POST">
                                                                            <a href="{{route('edit-headoffice-particular', $headoffice->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" onclick="return confirm('Are You Sure Deleted This Particular!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                                                        </form>

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
