@extends('admin.master')
@section('title', '')
@section('breadcrumb')
    <a href="{{ route('membership.create') }}" class="btn btn-primary btn-sm">Create</a>
@endsection
@section('content')

<section id="" class="table-layout animated fadeIn">
        <!-- begin: .tray-center -->
        <div class="tray tray-center">
            <h4> Membership List </h4>
            <!-- recent orders table -->
            <div class="panel">
                <div class="panel-body pn">
                    <div class="table-responsive">
                        <table class="table admin-form table-striped dataTable" id="datatable3">
                            <thead>
                                <tr class="bg-light">
                                    <th class="text-center"> SN </th>
                                    <th>Company Name</th>
                                    <th>DirectorName</th>
                                    <th>PhoneNumber</th>
                                    <th>MobileNumber</th>                                    
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data as $row)
                                    <tr class="id{{ $row->id }}">
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="post_title1 title_hi_sh"> 
                                            <strong> {!! $row->CompanyName !!} </strong>
                                            <div class="row_actions"><span class="id">ID: {{ $row->id }} | </span><span
                                                    class="edit"><a href="{{ route('membership.edit', $row->id) }}"
                                                        aria-label="">Edit</a> |
                                                </span><span class="trash"><a href="{{ $row->id }}"
                                                        class="submitdelete" aria-label="">Delete</a> </span>
                                        </td>
                                        <td class=""> {{ $row->DirectorName }} </td>
                                        <td class=""> {{ $row->PhoneNumber }} </td>
                                        <td class=""> {{ $row->MobileNumber }} </td>
                                        <td class=""> {{ $row->Email }} </td>
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
<script src="{{asset('/vendor/plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
<script src="{{asset('/vendor/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js')}}"></script>
<script src="{{asset('/vendor/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')}}"></script>
<script src="{{asset('vendor/plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script> 
    <script type="text/javascript">
        $('.submitdelete').on('click', function(e) {
            e.preventDefault();
            if (confirm('Are you sure to delete??')) {
                var csrf = $('meta[name="csrf-token"]').attr('content');
                var id = $(this).attr('href');
                var url =
                    '{{ route('membership.destroy', ':id') }}';
                url = url.replace(':id', id);
                $.ajax({
                    type: 'delete',
                    url: url,
                    data: {
                        _token: csrf
                    },
                    success: function(data) {
                        $('tbody tr.id' + id).remove();
                    },
                    error: function(data) {
                        alert('Error occurred!');
                    }
                });
            }
        });


        //
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
      "sSwfPath": "{{asset('vendor/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf')}}"
    }
  });

    </script>
@endsection
