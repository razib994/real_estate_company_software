
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h2 class="m-0 font-weight-bold text-primary">Head office overhead Amount   </h2>
            </div>
            @php
                $today =  date("Y-m-d");
$fi_to=0; $to='';
            @endphp
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                        <thead>
                        <tr>
                            <th> Sl </th>
                            <th> Particular Name </th>
                            <th> Date </th>
                            <th style="text-align: right !important;"> Amount </th>
                            <th> Payment Method </th>
                            <th> Note </th>

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

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="3"> Total </th>
                            <th colspan="3" style="text-align: right !important;"> <strong class="text-danger">

                                    {{ number_format($fi_to,2)  }}
                                </strong></th>

                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h2 class="m-0 font-weight-bold text-primary">Head office overhead Project Amount Total  </h2>
            </div>
            @php
                $today =  date("Y-m-d");
$fi_to=0; $to='';


            @endphp
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                        <thead>
                        <tr>
                            <th> Head office overhead  </th>
                            <th style="text-align: right !important;">  {{  number_format($headofficeoverheads->sum('amount'),2)  }} </th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td> Total Project Overhead</td>
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

