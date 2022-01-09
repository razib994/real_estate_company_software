@extends('backend.layouts.master')
@section('title')
    Visitors Create
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
            <h1 class="h3 mb-0 text-gray-800">  Create Visitors</h1>
            @if(Auth::guard('admin')->user()->can('visitor.view'))
            <a href="{{ route('visitors.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> Visitors List </a>
            @endif
        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Visitors Create </h6>
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
                <form action="{{route('visitors.store')}}" method="post" enctype='multipart/form-data'>
                    @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label">  Name</label>
                            <div class="col-sm-6">
                                <input type="text"  class="form-control" id="name" name="name" placeholder="Enter Your Name"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label"> Email</label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email"/>
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label"> Phone</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone" required/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="land_description" class="col-sm-3 col-form-label"> <strong>Land Description </strong> </label>
                        <div class="col-sm-6">

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="area" class="col-sm-3 col-form-label">Land Location</label>
                        <div class="col-sm-6">
                             <textarea class="form-control" id="area" name="area" placeholder="Enter Your Land Location"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="land_description" class="col-sm-3 col-form-label"> <strong> Details </strong> </label>
                        <div class="col-sm-6">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">Details</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="land" name="land" placeholder="Enter Land Area"/>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="width" name="width" placeholder="Enter Width"/>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="height" name="height" placeholder="Enter Length"/>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="road" name="road" placeholder="Enter Front Road"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="story" class="col-sm-3 col-form-label"> Storied </label>
                        <div class="col-sm-2">
                            <textarea class="form-control" id="store" name="store" placeholder="Enter Your Storied"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="demand" class="col-sm-3 col-form-label">Demand </label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="demand" name="demand" placeholder="Enter Demand"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="personal_information" class="col-sm-3 col-form-label"> <strong> Personal Information </strong> </label>
                        <div class="col-sm-6">

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="information" class="col-sm-3 col-form-label">Profession</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="profession_id" id="profession_id" required="">
                                <option  selected disabled > Enter Your Profession Name </option>
                                @php $profession = \App\Professional::all() @endphp
                                @foreach($profession as $pros)
                                <option value="{{ $pros->id }}"> {{ $pros->profession_name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="organization" class="col-sm-3 col-form-label">Organization</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="organization" name="organization" placeholder="Enter Your Organization"></textarea>
                        </div>
                    </div>
                   <div class="form-group row">
                        <label for="address" class="col-sm-3 col-form-label"> Address </label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="address" name="address" placeholder="Enter Your Address"></textarea>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="phone" class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" id="date" name="date" required placeholder="Enter Your Date"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="remark" class="col-sm-3 col-form-label">Remark</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="remark" name="remark" placeholder="Enter Your Remark"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="report" class="col-sm-3 col-form-label"> Feedback</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="report" name="report" placeholder="Enter Your Feedback"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="information" class="col-sm-3 col-form-label">Contact Person Setting </label>
                        <div class="col-sm-6">
                            <select class="form-control" name="contact_id" id="contact_id" required="">
                                <option  value="0" > Enter Your Contact Person Setting  </option>
                                @php $contact = \App\Contact::all() @endphp
                                @foreach($contact as $pros)
                                <option value="{{ $pros->id }}"> {{ $pros->person_name }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--<div class="form-group row">-->
                    <!--    <label for="contact_person" class="col-sm-3 col-form-label"> Contact Person Setting </label>-->
                    <!--    <div class="col-sm-6">-->
                    <!--        <input type="text"  class="form-control" id="contact_id" name="contact_id" placeholder="Enter Your Contact Person"/>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="form-group row">
                        <label for="check_file" class="col-sm-3 col-form-label">  Your File </label>
                        <div class="col-sm-6">
                            <input type="file" class="form-control" id="check_file" name="check_file" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="check_file_one" class="col-sm-3 col-form-label">  Your PDF </label>
                        <div class="col-sm-6">
                            <input type="file" class="form-control" id="check_file_one" name="check_file_one" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="check_file_two" class="col-sm-3 col-form-label">  Your WORD/EXCEL </label>
                        <div class="col-sm-6">
                            <input type="file" class="form-control" id="check_file_two" name="check_file_two" />
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



