@extends('admin.master')
@section('title','Create Vender')

@section('breadcrumb')  
@endsection

@section('content')
<form class="form-horizontal" role="form" action="/awarded-vender" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}  
  <input type="hidden" name="tender_id" value="" />  
  <div class="col-md-9">
    <!-- Input Fields -->
    <div class="panel">
      <div class="panel-heading">
        <span class="panel-title"> Add Vender </span>
      </div>
      <div class="panel-body"> 
              
        <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label">Vender Name </label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="" name="vender_name" class="form-control" placeholder="" />
            </div>
          </div>
        </div>

          <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label">Tender Number </label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="" name="tender_number" class="form-control" placeholder="" />
            </div>
          </div>
        </div>

          <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label">Tender Title </label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="" name="tender_title" class="form-control" placeholder="" />
            </div>
          </div>
        </div>

           <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label">Tender Category </label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="" name="tender_category" class="form-control" placeholder="" />
            </div>
          </div>
        </div>

          <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label">Awarded Date </label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="datepicker1" name="awarded_date" class="form-control" placeholder="" />
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label"> Date of NIT </label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="datepicker2" name="date_of_nit" class="form-control" placeholder="" />
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label"> Value </label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="" name="value" class="form-control" placeholder="" />
            </div>
          </div>
        </div>
        
        <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label"> Remarks </label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="" name="remarks" class="form-control" placeholder="" />
            </div>
          </div>
        </div>
<?php /* ?> 
        <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label">Email </label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="" name="email" class="form-control" placeholder="" />
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label">Phone</label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="" name="phone" class="form-control" placeholder="" />
            </div>
          </div>
        </div>     
        
          <div class="form-group">
            <label for="inputStandard" class="col-lg-3 control-label">Address </label>
            <div class="col-lg-8">
              <div class="bs-component">
                <input type="text" id="" name="address" class="form-control" placeholder="" />
              </div>
            </div>
          </div>
          <?php */ ?> 

           <div class="form-group">
            <label for="inputStandard" class="col-lg-3 control-label"></label>
            <div class="col-lg-8">
              <div class="bs-component">
                <input type="submit" class="btn btn-primary btn-sm" value="Publish" />
              </div>
            </div>
          </div>

        </div>

      </div>          
    </div>

</form>

@endsection