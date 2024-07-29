@extends('admin.master')
@section('title','Post')

@section('breadcrumb')
  <a href="{{ route('post.list',Request::segment(1)) }}" class="btn btn-primary btn-sm">List</a>
@endsection

@section('content')
<form class="form-horizontal" role="form" action="/manage-tender" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}    
  <div class="col-md-9">
    <!-- Input Fields -->
    <div class="panel">
      <div class="panel-heading">
        <span class="panel-title"> Add Tender </span>
      </div>
      <div class="panel-body"> 
        <input type="hidden" name="post_date" value="<?=date('Y-m-d h:i:s')?>" />              
        <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label">Tender Number</label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="" name="tender_number" class="form-control" placeholder="" />
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label">Tender Subject</label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="" name="tender_subject" class="form-control" placeholder="" />
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="inputStandard" class="col-lg-3 control-label">Tender Location</label>
          <div class="col-lg-8">
            <div class="bs-component">
              <input type="text" id="" name="tender_location" class="form-control" placeholder="" />
            </div>
          </div>
        </div>
@if($tendercat->count() > 0)
        <div class="form-group">
          <label for="inputSelect" class="col-lg-3 control-label"> Tender Category </label>
          <div class="col-lg-8">
            <div class="bs-component">
              <select name="category" class="form-control">
                <option value="0"> Select Category </option>
                 
                  @foreach($tendercat as $row)
                  <option value="{{$row->id}}"> {{$row->tender_category}}</option>
                  @endforeach  
       
            </select>
              <div id="source-button" class="btn btn-primary btn-xs" style="display: none;">&lt; &gt;</div></div>
            </div>
          </div>
          @endif

          <div class="form-group">
            <label class="col-lg-3 control-label" for="textArea2"> Tender Detail </label>
            <div class="col-lg-9">
              <div class="bs-component">
                <textarea class="form-control my-editor" id="" name="tender_detail" rows="3"></textarea>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="inputStandard" class="col-lg-3 control-label">NIT Date</label>
            <div class="col-lg-8">
              <div class="bs-component">
                <input type="text" id="datepicker1" name="nit_date" class="form-control" placeholder="" />
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label" for="textArea3"> Last Date of Submittion </label>
            <div class="col-lg-8">
              <div class="bs-component">
                <input type="text" id="datepicker2" name="last_date_of_submittion" class="form-control" placeholder="" />
              </div>
            </div>
          </div> 

          <div class="form-group">
            <label class="col-lg-3 control-label" for="textArea3"> Time of Submittion </label>
            <div class="col-lg-8">
              <div class="bs-component">
                <input type="text" id="inputStandard" name="time_of_submittion" class="form-control" placeholder="06:15 AM" />
              </div>
            </div>
          </div> 

        </div>

      </div>          
    </div>

    <div class="col-md-3">
      <div class="admin-form">
        <div class="sid_bvijay mb10">                   
          <div class="hd_show_con">
            <div class="publice_edi">
             <!--  Status: <a href="avoid:javascript;" data-toggle="collapse" data-target="#publish_1">Active</a> -->
           </div>                    
         </div>
         <footer>                        
          <div id="publishing-action">
            <input type="submit" class="btn btn-primary btn-sm" value="Publish" />
          </div>
          <div class="clearfix"></div>
        </footer>
        <div class="clearfix"></div>
      </div>

      <div class="sid_bvijay mb10">
        <label class="field text">
          <label> Is New? </label>
          <input type="checkbox" id="inputStandard" name="is_new" value="1" />   
        </label>
      </div>

    </div>         

  </div>
</form>

@endsection

@section('additional-css')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection