@extends('admin.master')
@section('title','Setting')
@section('breadcrumb')
@endsection
@section('content')

<form class="form-horizontal" role="form" action="{{ url('admin/settings',1) }}" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}
           <input type="hidden" name="_method" value="PUT" />
<div class="col-md-9">
            <!-- Input Fields -->
            <div class="panel">
              <div class="panel-heading">
                <span class="panel-title">Settings</span>
              </div>
              <div class="panel-body">

                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Site Name</label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="text" id="" name="site_name" class="form-control" placeholder="" value="{{$data->site_name}}" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Location</label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="text" id="" name="location1" class="form-control" placeholder="" value="{{$data->location1}}" />
                         <!--  <input type="text" id="" name="location2" class="form-control" placeholder="" value="{{$data->location2}}" /> -->
                      </div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Email Primary</label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="text" id="" name="email_primary" class="form-control" placeholder="" value="{{$data->email_primary}}" />
                      </div>
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Email Secondary</label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                       <input type="text" id="" name="email_secondary" class="form-control" placeholder="" value="{{$data->email_secondary}}" />
                      </div>
                    </div>
                  </div>
                 <!--  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Email RTS</label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                       <input type="text" class="form-control" id="" name="address2" value="{{$data->address2}}" />
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Email Online</label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                       <input type="text" id="" name="website2" class="form-control" placeholder="" value="{{$data->website2}}" />
                      </div>
                    </div>
                  </div> -->


                   <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Phone Primary</label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="text" id="" name="phone" class="form-control" placeholder="" value="{{$data->phone}}" />
                      </div>
                    </div>
                  </div>
                    <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Phone Secondary</label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                       <input type="text" id="" name="phone2" class="form-control" placeholder="" value="{{$data->phone2}}" />
                      </div>
                    </div>
                  </div>
                   <!--  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Viber No</label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                       <input type="text" class="form-control" id="" name="address" value="{{$data->address}}" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Website </label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="text" id="" name="website" class="form-control" placeholder="" value="{{$data->website}}" />
                      </div>
                    </div>
                  </div> -->

                <div class="form-group">
                    <label class="col-lg-3 control-label" for="textArea2"> Contact Page Map</label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <textarea class="form-control" id="" name="google_map2" rows="3">{{$data->google_map2}}</textarea>
                      </div>
                    </div>
                  </div>

                    <div class="form-group">
                    <label class="col-lg-3 control-label" for="textArea2"> Timing </label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="text" class="form-control" id="" name="welcome_title" rows="3" value="{{$data->welcome_title}}" />
                      </div>
                    </div>
                  </div>

                  <!--   <div class="form-group">
                    <label class="col-lg-3 control-label" for="textArea2">Welcome Text</label>
                    <div class="col-lg-9">
                      <div class="bs-component">
                        <textarea class="form-control my-editor" id="" name="welcome_text" rows="3">{{$data->welcome_text}}</textarea>
                      </div>
                    </div>
                  </div> -->

                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Meta Key</label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="text" id="" name="meta_key" class="form-control" placeholder="" value="{{$data->meta_key}}" />
                      </div>
                    </div>
                  </div>

                   <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Meta Description</label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <input type="text" id="" name="meta_description" class="form-control" placeholder="" value="{{$data->meta_description}}" />
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-lg-3 control-label" for="textArea2">Copyright Text</label>
                    <div class="col-lg-8">
                      <div class="bs-component">
                        <textarea class="form-control" id="" name="copyright_text" rows="3">{{$data->copyright_text}}</textarea>
                      </div>
                    </div>
                  </div>
                   <?php /*?>
                  <div class="form-group">
                      <label class="col-lg-3 control-label" for="textArea2">Field 1</label>
                      <div class="col-lg-8">
                          <div class="bs-component">
                              <textarea class="form-control" id="" name="field1" rows="3">{{$data->field1}}</textarea>
                          </div>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-lg-3 control-label" for="textArea2">Field 2</label>
                      <div class="col-lg-8">
                          <div class="bs-component">
                              <textarea class="form-control" id="" name="field2" rows="3">{{$data->field2}}</textarea>
                          </div>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-lg-3 control-label" for="textArea2">Field 3</label>
                      <div class="col-lg-8">
                          <div class="bs-component">
                              <textarea class="form-control" id="" name="field3" rows="3">{{$data->field3}}</textarea>
                          </div>
                      </div>
                  </div>

                  <div class="form-group">
                      <label class="col-lg-3 control-label" for="textArea2">Field 4</label>
                      <div class="col-lg-8">
                          <div class="bs-component">
                              <textarea class="form-control" id="" name="field4" rows="3">{{$data->field4}}</textarea>
                          </div>
                      </div>
                  </div>

                    <div class="form-group">
                    <label class="col-lg-3 control-label" for="textArea2"> Home Page Map</label>
                    <div class="col-lg-9">
                    <div class="bs-component">


                <input type="text" id="" name="signin_url" class="form-control" placeholder="" value="{{$data->signin_url}}" />
                  <input type="text" id="" name="signup_url" class="form-control" placeholder="" value="{{$data->signup_url}}" />
                     <input type="text" class="form-control" id="" name="location_link" value="{{$data->location_link}}" />
                      <textarea class="form-control" id="contentEditor1" name="google_map" rows="3">{{$data->google_map}}</textarea>
                      </div>
                    </div>
                  </div>
                        <?php */?>

                  <div class="form-group">
                    <label class="col-lg-3 control-label" for=""></label>
                    <div class="col-lg-6">
                      <div class="bs-component">
                        <input type="submit" class="form-control btn btn-primary" name="submit" value="Submit" />
                      </div>
                    </div>
                  </div>

              </div>
            </div>
          </div>
        <div class="col-md-3">
        <div class="admin-form">


             <div class="sid_ mb10">
          <h4> Facebook Link </h4>
            <div class="bs-component">
              <input type="text" id="" name="facebook_link" class="form-control" placeholder="" value="{{$data->facebook_link}}" />
            </div>
           </div>
           <div class="sid_ mb10">
          <h4>Linkedin </h4>
              <div class="bs-component">
                <input type="text" id="" name="linkedin_link" class="form-control" placeholder="" value="{{$data->linkedin_link}}" />
              </div>
           </div>
            <div class="sid_ mb10">
          <h4> Instagram </h4>
               <div class="bs-component">
                  <input type="text" id="" name="instagram_link" class="form-control" placeholder="" value="{{$data->instagram_link}}" />
                </div>
           </div>
          <!--    <div class="sid_ mb10">
          <h4> Google Plus</h4>
            <div class="bs-component">
               <input type="text" id="" name="google_plus" class="form-control" placeholder="" value="{{$data->google_plus}}" />
            </div>
           </div> -->
          <div class="sid_ mb10">
          <h4> Twitter Link </h4>
           <div class="bs-component">
              <input type="text" id="" name="twitter_link" class="form-control" placeholder="" value="{{$data->twitter_link}}" />
            </div>
           </div>
            <div class="sid_ mb10">
          <h4> You Tube</h4>
            <div class="bs-component">
               <input type="text" id="" name="experience" class="form-control" placeholder="" value="{{$data->experience}}" />
            </div>
           </div>

        </div>
        </div>
      </form>
@endsection
