@extends('admin.master')
@section('title','Post')

@section('breadcrumb')
<a href="{{ route('tender-category.create') }}">Create</a>
@endsection

@section('content')
<section id="content" class="table-layout animated fadeIn">
  <!-- begin: .tray-center -->
  <div class="tray tray-center">
   <h4> Tender Category </h4>
   <!-- recent orders table -->
   <div class="panel">
    <div class="panel-body pn">
      <div class="table-responsive">
      	@if($data->count() > 0)
        <table class="table admin-form table-striped dataTable" id="datatable3">
          <thead>
            <tr class="bg-light">
              <th> SN </th>
              <th> Tender Category </th>
              <th> Created </th>
            </tr>
          </thead>
          <tbody>

            @foreach($data as $row)
            <tr class="id{{$row->id}}">
              <td> {{ $loop->iteration }} </td>
              <td class="title_hi_sh">                
                <strong><a href="{{route('tender-category.edit', $row->id)}}"> 
                      {{ ucfirst($row->tender_category) }} </a></strong>
                <div class="row_actions"><span class="id">ID: {{$row->id}} | </span><span class="edit"><a href="{{route('tender-category.edit', $row->id)}}">Edit</a> | </span><span class="trash"><a href="#{{$row->id}}" class="submitdelete" aria-label="">Delete</a> </span>
                </td>             
               <td>{{$row->created_at}} </td>
              
              </tr>
              @endforeach 

            </tbody>
          </table>
          @endif
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
  $('document').ready(function(){
    // Select Checkbox
    $('#checkAll').on('click',function(e){
      if($(this).is(':checked', true)){
        $('.check_box').prop('checked', true);
      }else{
        $('.check_box').prop('checked', false);
      }
    });
    // Delete Data
    $('.deleteAll').on(function(){

    });
  });


  // Data Table
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

  // Delete row
  $('.submitdelete').on('click',function(e){
    e.preventDefault();
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var str = $(this).attr('href');
    var id = str.slice(1);
    var url = '{{ route("tender-category.update",':id') }}';
        url = url.replace(':id',id);
    $.ajax({
      type:'delete',
      url:url,
      data:{_token:csrf},    
      success:function(data){  
       alert(data);             
       $('tbody tr.id' + id ).remove();
     },
     error:function(data){       
       alert('Error occurred!');
     }
   });
  });

</script>

@endsection