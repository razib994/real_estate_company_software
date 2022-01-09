<div class="container-fluid">
        <div class="row">
            <div class="col-md-6"></div>
        </div>
        <!-- DataTales Example -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h2 class="m-0 font-weight-bold text-primary">Head office overhead Project Amount   </h2>
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
                            <th> Project Name </th>
                            <th> Date </th>
                            <th style="text-align: right !important;"> Amount </th>
                            <th> Payment Method </th>
                            <th> Note </th>
                        </tr>
                        </thead>


                        <tbody>
                        {{--                        @foreach($client->clientPayments as $clientPayment)--}}
                        @foreach($overheadprojects as $overheadproject)
                            <tr>
                                <td>

                                    {{ $overheadproject->id  }}
                                </td>
                                <td>
                                    {{ $overheadproject->project->project_name }}
                                    {{--                                    @php $pros = \App\Project::where('id',$overheadproject->project_id)->get(); foreach ($pros as $pro)  @endphp--}}

                                    {{--                                    {{ $pro->project_name  }}--}}
                                </td>
                                <td>{{ $overheadproject->date  }}</td>
                                <td style="text-align: right !important;">

                                    {{ number_format( $to = $overheadproject->amount, 2)  }}

                                    @php
                                        $fi_to = $fi_to + $to;
                                    @endphp
                                </td>
                                <td> @if( $overheadproject->payment_method == 'check') Cheque @elseif($overheadproject->payment_method == 'open') Opening Balance @elseif($overheadproject->payment_method == 'refund') Refund @else Cash @endif</td>
                                <td>{{ $overheadproject->note  }}</td>

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
    </div>

