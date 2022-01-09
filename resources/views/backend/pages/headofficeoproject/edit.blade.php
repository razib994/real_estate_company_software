@extends('backend.layouts.master')
@section('title')
    Head office  Project Create
@endsection
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">  Create Head office Project Amount </h1>

        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Head office Project Amount </h6>
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
                <form action="{{ route('update-overhead-project') }}" method="post" enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group row">
                        <label for="project_id" class="col-sm-3 col-form-label"> Project Name </label>
                        <div class="col-sm-6">
                            <input type="hidden" class="form-control" id="id" value="{{ $overheadProject->id }}" name="id" />
                            <select class="form-control" id="project_id" name="project_id">
                                <option selected disabled > Project Name </option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" @if($project->id == $overheadProject->project_id) selected @endif>  {{  $project->project_name }}  </option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="date" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" id="date" value="{{ $overheadProject->date }}" name="date" placeholder="Enter Your Date"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-3 col-form-label">Amount Percentage</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control percent" id="percent"  name="percent" value="{{$overheadProject->percent}}" placeholder="Value Your %"/>
                        </div>
                    </div>
                    {{--                    <div class="form-group row">--}}
                    {{--                        <label for="bank_id" class="col-sm-3 col-form-label"> Bank Name </label>--}}
                    {{--                        <div class="col-sm-6">--}}
                    {{--                            <select class="form-control" id="bank_id" name="bank_id">--}}
                    {{--                                <option value="0" > Select Your Bank </option>--}}
                    {{--                                @foreach($banks as $bank)--}}
                    {{--                                    <option value="{{ $bank->id }}">  {{  $bank->bank_name }}  </option>--}}
                    {{--                                @endforeach--}}
                    {{--                            </select>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="form-group row">
                        <label for="payment_method" class="col-sm-3 col-form-label"> Payment Method </label>
                        <div class="col-sm-6">
                            <select class="form-control" id="payment_method" name="payment_method">
                                <option selected disabled > Select Your Payment Method </option>
                                <option value="cash" @if($overheadProject->payment_method =='cash') selected @endif> Cash </option>
                                <option value="check" @if($overheadProject->payment_method =='check') selected @endif> Cheque </option>
                                <option value="open" @if($overheadProject->payment_method =='open') selected @endif> Opening Balance </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="note" class="col-sm-3 col-form-label">Note </label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="note" name="note" > {{ $overheadProject->note }} </textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="submits" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-6">
                            <input type="submit" class="btn btn-primary" id="submits" name="submit" value="Submit"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection



