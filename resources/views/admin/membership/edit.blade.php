@extends('admin.master')
@section('breadcrumb')
    <a href="{{ route('membership.index') }}" class="btn btn-primary btn-sm">List</a>
@endsection
@section('content')
    <div class="alert" id="message" style="display: none"></div>
    <form class="form-horizontal" id="upload_image1" role="form" action="{{ route('membership.update', $data->id) }}"
        method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT" />
        <div class="col-md-8">
            <!-- Input Fields -->
            <div class="panel">
                <div class="panel-heading">
                    <span class="panel-title">Edit Membership</span>
                </div>
                <div class="panel-body">

                <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> Company Name </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" name="CompanyName" value="{!! $data->Company ? $data->Company : '' !!}" class="form-control" />
                            </div>
                        </div>                       
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> Url </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="url" placeholder="https://example.com" name="Url" value="{{ $data->Url ? $data->Url : '' }}" class="form-control" />
                            </div>
                        </div>                        
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> Director Name  </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" name="DirectorName" value="{{ $data->DirectorName ? $data->DirectorName : '' }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                        <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> Phone Number </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" name="PhoneNumber" value="{{ $data->PhoneNumber ? $data->PhoneNumber : '' }}" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> Mobile Number </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="text" name="MobileNumber" value="{{ $data->MobileNumber ? $data->MobileNumber : '' }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> Email </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="email" name="Email" value="{{ $data->Email ? $data->Email : '' }}" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputStandard" class="col-lg-3 control-label"> </label>
                        <div class="col-lg-8">
                            <div class="bs-component">
                                <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </form>
@endsection
