@php foreach ($shows as $show)
    $today =  date("Y-m-d");
$fi_to=0; $to='';
@endphp
<h2>{{ $show->items_name }}</h2>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th> Date </th>
                            <th style="text-align: right !important;">Amount</th>
                            <th> Payment Method </th>
                            <th> Note </th>

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
                            </tr>
                            @php $fi_to = $fi_to+$to;@endphp
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="2">Total</th>
                            <th colspan="3" style="text-align: right !important;"><strong class="text-danger"> {{ number_format($fi_to,2) }} </strong></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>


