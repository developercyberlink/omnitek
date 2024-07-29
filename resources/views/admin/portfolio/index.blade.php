@extends('admin.master')
@section('title', Request::segment(2))
@section('breadcrumb')
<a href="{{ route('our-trades.create') }}" class="btn btn-primary btn-sm">Create</a>
@endsection
@section('content')
<section class="table-layout animated fadeIn">
  <!-- begin: .tray-center -->
  <div class=""> 
   <h4>  </h4>
   <!-- recent orders table -->
   <div class="panel">
    <div class="panel-body pn">
      <div class="table-responsive">
        <table class="table admin-form table-striped dataTable" id="datatable3">
          <thead>
            <tr class="bg-light">
              <th class="text-center"> SN </th>
              <th>Post Name</th>
              <th></th>
              <th>Order</th>  
              <th></th>                          
              <th>Published</th>
            </tr>
          </thead>
          <tbody>
          @if($data->count() > 0)
            @foreach($data as $row)
            <tr class="id{{$row->id}}">
              <td class="text-center">
                {{$loop->iteration}}
              </td>
              <td class="post_title title_hi_sh">                 
                    <strong> {{ $row->title }} </strong>          
                <div class="row_actions"><span class="id">ID: {{$row->id}} | </span><span class="edit"><a href="{{url( 'admin/'.Request::segment(2) .'/'. $row->id. '/edit')}}" aria-label="">Edit</a> 
                 </span>              
                <span class="trash"><a href="#{{$row->id}}" class="submitdelete1">Delete</a> </span>
                </td>
                <td> <a href="{{url('admin/associates/'.Request::segment(2).'/'.$row->id)}}" title="Associated posts">
              <i class="fa fa-list-ol"></i>
              </a></td>
                <td class="categories">                  
                  {{ $row->ordering }}
                </td>
              <td>
                
                <?php /* ?>  
                 <a href="{{ route('doc.multipledocument',$row->id) }}" title="PDF">
                  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                </a>
                <a href="{{ route('admin.multiplephoto', $row->id ) }}" title="Photo">
                  <i class="fa fa-picture-o" aria-hidden="true"></i>
                </a> 
                  <a href="{{ url('admin/multiplevideo/' . $row->id ) }}" title="Video">
                  <i class="fa fa-video-camera" aria-hidden="true"></i>
                  </a>
                  <?php */ ?>                 
                </td>
                <td class="date"> {{$row->created_at}} </td>             
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- end: .tray-center -->
</section>
@endsection
@section('libraries')
<!-- Datatables -->
<script src="{{asset(env('PUBLIC_PATH').'vendor/plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
<!-- Datatables Tabletools addon -->
<script src="{{asset(env('PUBLIC_PATH').'vendor/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js')}}"></script>
<!-- Datatables ColReorder addon -->
<script src="{{asset(env('PUBLIC_PATH').'vendor/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')}}"></script>
<!-- Datatables Bootstrap Modifications  -->
<script src="{{asset(env('PUBLIC_PATH').'vendor/plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script>
<script type="text/javascript">
(function ( $ ) { 
  $('.submitdelete1').on('click',function(e){
    e.preventDefault();
    if(confirm('Are you sure to delete??')){
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var str = $(this).attr('href');
    var id = str.slice(1);
    $.ajax({
      type:'delete',
      url:"{{url('admin').'/'.Request::segment(2).'/'}}" + id,
      data:{_token:csrf},    
      success:function(data){  
      $('tbody tr.id' + id ).remove();
     },
     error:function(data){       
       alert('Error occurred!');
     }
   });
   }
  }); 
}( jQuery ));
/********/
  $('document').ready(function(){
    $('#checkAll').on('click',function(e){
      if($(this).is(':checked', true)){
        $('.check_box').prop('checked', true);
      }else{
        $('.check_box').prop('checked', false);
      }
    });
    $('.deleteAll').on(function(){

    });
  });


  /************/
  $('#datatable3').dataTable({
    "aoColumnDefs": [{
      'bSortable': true,
      'aTargets': [-1]
    }],
    "oLanguage": {
      "oPaginate": {
        "sPrevious": "Previous",
        "sNext": "Next"
      }
    },
    "iDisplayLength": 10,
    "aLengthMenu": [
    [5, 10, 25, 50, -1],
    [5, 10, 25, 50, "All"]
    ],
    "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
    "oTableTools": {
      "sSwfPath": "{{asset(env('PUBLIC_PATH'))}}vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
    }
  });
</script>
@endsection