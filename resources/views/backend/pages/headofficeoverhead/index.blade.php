@extends('backend.layouts.master')
@section('title')
    Head office overhead Amount  List
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><b class="text-danger"> </b></h1>

            <form action="{{ route('manage-overhead-particular') }}"  method="get">
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <input type="date" class="form-control" required name="start_date" id="start_date"  placeholder="Start Date">
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
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6 mb-2 text-right">
                <a href="" class="btn btn-warning btn-sm "><i class="fas fa-backward " aria-hidden="true"></i> Back </a>

                {{--            <a href="{{ url('admin/clients-payments-export-csv') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-csv text-success" aria-hidden="true"></i> CSV</a>--}}
                <a href="{{ url('admin/clients-payments-export-excel') }}" class="btn btn-light btn-sm border"><i class="fas fa-file-excel text-success" aria-hidden="true"></i> Excel</a>
                <a href=" {{ route('project-expense-pdf',[$start_date, $end_date]) }}" class="btn btn-light btn-sm border"><i class="fas fa-file-pdf text-danger" aria-hidden="true"></i> PDF</a>
                {{--            <a href="" class="btn btn-light btn-sm border"><i class="fas fa-print" aria-hidden="true"></i> Print </a>--}}
            </div>
        </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Head office overhead Amount   </h6>
            </div>
            @php
                $today =  date("Y-m-d");
$fi_to=0; $to='';
            @endphp
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th> Sl </th>
                            <th> Particular Name </th>
                            <th> Date </th>
                            <th style="text-align: right !important;"> Amount </th>
                            <th> Payment Method </th>
                            <th> Note </th>
                            <th width="15%">Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        {{--                        @foreach($client->clientPayments as $clientPayment)--}}
                        @foreach($headofficeoverheads as $headofficeoverhead)
                            <tr>
                                <td>
                                    {{ $headofficeoverhead->id  }}</td>
                                <td>
                                    @php $particulars = \App\HeadOffice::where('id',$headofficeoverhead->particular_id)->get(); foreach ($particulars as $particular)  @endphp
                                    {{ $particular->particular_name  }}
                                </td>
                                <td>{{ $headofficeoverhead->date  }}</td>
                                <td style="text-align: right !important;">

                                    {{ number_format( $to = $headofficeoverhead->amount, 2)  }}

                                    @php
                                        $fi_to = $fi_to + $to;
                                    @endphp
                                </td>
                                <td> @if( $headofficeoverhead->payment_method == 'check') Cheque @elseif($headofficeoverhead->payment_method == 'open') Opening Balance @elseif($headofficeoverhead->payment_method == 'refund') Refund @else Cash @endif</td>
                                <td>{{ $headofficeoverhead->note  }}</td>
                                <td>
                                    <form action="{{route('delete-overhead-expense', ['id' => $headofficeoverhead->id])}}" method="POST">
                                        <a href="{{route('edit-overhead-expense', ['id' => $headofficeoverhead->id]) }}" class="btn btn-success btn-sm"> <i class="fa fa-edit"></i> </a>
                                        @csrf

                                        <button type="submit" onclick="return confirm('Are You Sure Deleted This Client Payments!');" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="3"> Total </th>
                            <th colspan="3" style="text-align: right !important;"> <strong class="text-danger">

                                    {{ number_format($fi_to,2)  }}
                                </strong></th>
                            <th width="15%"> Action </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Head office overhead Project Amount Total  </h6>
            </div>
            @php
                $today =  date("Y-m-d");
$fi_to=0; $to='';


            @endphp
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th> Head office overhead  </th>
                            <th style="text-align: right !important;">  {{  number_format($headofficeoverheads->sum('amount'),2)  }} </th>
                        </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td> <a href="{{ route('manage-overhead-project') }}" style="text-decoration: none;">Total Project Overhead </a>  <a href="{{ route('create-overhead-project') }}" class="btn btn-primary btn-sm"> Add </a> </td>
                                <td style="text-align: right !important;">{{  number_format($overheadprojects->sum('amount'),2)  }}</td>

                            </tr>

                        </tbody>
                        <tfoot>
                        <tr>
                            <th> Total </th>
                            <th style="text-align: right !important;"> <strong class="text-danger">

                                    {{ number_format($headofficeoverheads->sum('amount') -$overheadprojects->sum('amount'),2)  }}
                                </strong></th>

                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
