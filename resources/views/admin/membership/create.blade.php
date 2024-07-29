@extends('admin.master')
@section('breadcrumb')
    <a href="{{ route('membership.index') }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
    <div class="alert" id="message" style="display: none"></div>
    <form class="form-horizontal" role="form" action="{{ route('membership.store') }}" method="post"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="col-md-8">
            <!-- Input Fields -->
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Add Membership</span>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> Company Name </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" name="CompanyName" class="form-control" />
                            </div>
                        </div>                       
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> Url </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="url" placeholder="https://example.com" name="Url" class="form-control" />
                            </div>
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> Director Name  </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" name="DirectorName" class="form-control" />
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> Phone Number </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" name="PhoneNumber" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> Mobile Number </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" name="MobileNumber" class="form-control" />
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> Email </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="email" name="Email" class="form-control" />
                            </div>
                        </div>
                    </div>

                
                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        <div class="col-md-4">
            
        </div>
    </form>
@endsection
