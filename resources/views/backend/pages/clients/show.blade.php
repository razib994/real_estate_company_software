@extends('backend.layouts.master')
@section('title')
    Client Information
@endsection
@section('content')

    <div class="container-fluid">
    {{--        @if (Session::has('message'))--}}
    {{--            <div class="alert alert-success">--}}
    {{--                <div>--}}
    {{--                    <p>{{ Session::get('message') }}</p>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--    @endif--}}
    <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Clients - {{ $client->client_name }}</h1>
            <a href="{{ route('clients.payments', $client->id)}}" class="d-none d-sm-inline-block float-right btn btn-sm btn-success shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> Clients Payment Details List </a>
            <a href="{{ route('clients.created', $client->id)}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Collection Amount </a>
        </div>
{{--        <div class="row">--}}
{{--            <div class="col-md-6"></div>--}}
{{--            <div class="col-md-6 mb-2 text-right">--}}
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>--}}
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>--}}
{{--                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-3">
                        <h6 class="m-0 font-weight-bold text-primary">Clients - {{ $client->client_name }} </h6>
                    </div>
                    <div class="col-md-9">

                    </div>
                </div>


            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th scope="row" class="text-left"> Project Name : </th>
                        <td>{{ $client->project->project_name }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-left"> Name : </th>
                        <td>{{ $client->client_name }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-left"> Phone : </th>
                        <td>{{ $client->phone }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-left"> Address : </th>
                        <td>{{ $client->address }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-left"> Floor : </th>
                        <td>{{ $client->floor }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-left"> Apartment : </th>
                        <td>{{ $client->apartment }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-left"> Total Amount : </th>
                        <td>{{ number_format($client->amount, 2)  }} </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-left"> Total Payment : </th>
                        <td>{{  number_format($client->clientPayments->sum('amount'),2) }} </td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-left"> Due Payment : </th>
                        <td><b class="text-danger"> {{ number_format($client->amount - $client->clientPayments->sum('amount'),2) }}</b> </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
