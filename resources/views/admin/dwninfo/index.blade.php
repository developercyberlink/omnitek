@extends('admin.master')
@section('title', Request::segment(2))
@section('breadcrumb')
@endsection
@section('content')
<style>
.post_title{width:25% !important;}
</style>
<section id="" class="table-layout animated fadeIn">
  <!-- begin: .tray-center -->
  <div class="">
   <h4> Download Information </h4>
   <!-- recent orders table -->
   <div class="panel">
    <div class="panel-body pn">
      <div class="table-responsive">
        <table class="table admin-form table-striped dataTable" id="datatable3">
          <thead>
            <tr class="bg-light">
              <th class="text-center"> SN </th>
              <th>Document Title</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Email</th>  
              <th>Date</th>                          
            </tr>
          </thead>
          <tbody>

            @foreach($data as $row)
            <tr class="id{{$row->id}}">
              <td class="text-center">
                {{$loop->iteration}}
              </td>
              <td class="post_title title_hi_sh">{{ ucfirst($row->title) }} 
              <div class="row_actions">
                <span class="id">ID: {{$row->id}} | </span> 
                <span class="trash"><a href="#{{$row->id}}" class="submitdelete1">Delete</a> </span>
                </div>
              </td>
              <td class=""> {{ ucfirst($row->first_name) }} {{ ucfirst($row->last_name) }}  
                </td>
                <td>{{$row->email}}</td>      
                 <td>{{$row->phone}}</td>      
                <td class="date"> {{$row->created_at}} </td>             
              </tr>
              @endforeach

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
      url:"{{url('/dwn/dwninfo').'/'}}" + id,
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
 /************/
 $('#datatable3').dataTable({
  	 "order": [[ 0, "asc" ]],
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
      "sSwfPath": "{{asset(env('PUBLIC_PATH').'vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf')}}"
    }
  });

</script>

@endsection