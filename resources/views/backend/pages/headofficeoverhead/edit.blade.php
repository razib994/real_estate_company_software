@extends('backend.layouts.master')
@section('title')
    Head office  Create
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">  Create Head office overhead Amount </h1>

        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Head office overhead Amount </h6>
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
                <form action="{{ route('update-overhead-expense') }}" method="post" enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group row">
                        <label for="particular_name" class="col-sm-3 col-form-label"> Particular Name </label>
                        <div class="col-sm-6">
                            <input type="hidden" class="form-control" id="id" value="{{$headofficeoverhead->id}}" name="id" />
                            <select class="form-control" id="particular_id" name="particular_id">
                                <option selected disabled > Particular Name </option>
                                @foreach($headoffices as $headoffice)
                                    <option value="{{ $headoffice->id }}" @if($headoffice->id == $headofficeoverhead->particular_id) selected @endif >  {{  $headoffice->particular_name }}  </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-6">

                                <input type="date" class="form-control date" id="date" name="date" value="{{$headofficeoverhead->date}}"  placeholder="Start Date"/>
                                <input type="hidden" class="form-control" id="end_date" name="end_date" value="{{$headofficeoverhead->end_date}}" placeholder="End Date"/>
                                <input type="hidden" class="form-control start_date" id="start_date" name="start_date" value="{{$headofficeoverhead->start_date}}" placeholder="Start Date"/>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label">Amount</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="amount" value="{{$headofficeoverhead->amount}}" name="amount" placeholder="Enter Your Amount"/>
                        </div>
                    </div>
                                        <div class="form-group row">
                                            <label for="bank_id" class="col-sm-3 col-form-label"> Bank Name </label>
                                            <div class="col-sm-6">
                                                <select class="form-control" id="bank_id" name="bank_id">
                                                    <option value="0" > Select Your Bank </option>
                                                    @foreach($banks as $bank)
                                                        <option value="{{ $bank->id }}" @if($headofficeoverhead->bank_id==$bank->id) selected @endif>  {{  $bank->bank_name }}  </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                    <div class="form-group row">
                        <label for="payment_method" class="col-sm-3 col-form-label"> Payment Method </label>
                        <div class="col-sm-6">
                            <select class="form-control" id="payment_method" name="payment_method">
                                <option selected disabled > Select Your Payment Method </option>
                                <option value="cash" @if($headofficeoverhead->payment_method =='cash') selected @endif> Cash </option>
                                <option value="check" @if($headofficeoverhead->payment_method =='check') selected @endif> Cheque </option>
                                <option value="open" @if($headofficeoverhead->payment_method =='open') selected @endif> Opening Balance </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="note" class="col-sm-3 col-form-label">Note </label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="note" name="note" > {{ $headofficeoverhead->note }}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="submits" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-6">
                            <input type="submit" class="btn btn-success" id="submits" name="submit" value="Update"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.date').blur(function (){
                var da =$('#date').val();
                var df =new Date(da);
                var firstDay = new Date(df.getFullYear(), df.getMonth(), 1);
                var finaldayf = firstDay.toLocaleDateString('fr-ca');
                var lastDay = new Date(df.getFullYear(), df.getMonth() + 1, 0);
                var finaldayl = lastDay.toLocaleDateString('fr-ca');
                $('#start_date').val(finaldayf);
                $('#end_date').val(finaldayl);
            })
        });
    </script>
@endsection



