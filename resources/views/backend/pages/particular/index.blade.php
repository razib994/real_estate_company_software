@extends('backend.layouts.master')
@section('title')
    Particular Amount  List
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b class="text-danger"> </b> </h1>
                @php foreach ($shows as $show) @endphp
            <form action="{{ route('projects.particulars',[$project->id, $show->id]) }}"  method="get">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <input type="date" class="form-control" required name="start_date" id="start_date" placeholder="Start Date">
                    </div>
                    <div class="col-auto">
                        <input type="date" class="form-control" required name="end_date" id="end_date" placeholder="End Date">

                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Report</button>
                    </div>
                </div>
            </form>
        </div>
        @php
            $today =  date("Y-m-d");
$fi_to=0; $to='';
        @endphp
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">

                <a href="" class="btn btn-warning btn-sm "><i class="fas fa-backward " aria-hidden="true"></i> Back </a>
                <a href="" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href="{{ url('admin/particulars-pdf',[$project->id, $show->id, $start_date, $end_date]) }}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
                {{--            <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@php  echo $show->items_name @endphp</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th> Date </th>
                            <th style="text-align: right !important;">Amount</th>
                            <th> Payment Method </th>
                            <th> Note </th>
                            <th> Cheque Image </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($project_payments as $project_payment)
                        <tr>
                                <td> {{$loop->iteration}} </td>
                                <td> {{ $project_payment->date }} </td>
                                <td> {{ $to = $project_payment->amount }} </td>
                                <td>  @if( $project_payment->payment_method == 'check') Cheque @elseif($project_payment->payment_method == 'open') Opening Balance @else Cash @endif</td>
                                <td>{{  $project_payment->note }}</td>
                                <td> <img src="{{ asset($project_payment->check_file) }}" width="40px" height="40px" /> </td>
                            </tr>
                            @php $fi_to = $fi_to+$to;@endphp
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="2">Total</th>
                            <th colspan="4" style="text-align: right !important;"><strong class="text-danger"> {{ number_format($fi_to,2) }} </strong></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
