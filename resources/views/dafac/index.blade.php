@extends('layouts.main')
@section('stylesheet')
<link href="{{ asset('DataTables-1.10.13/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/jquery-confirm.min.css') }}" rel="stylesheet">
@stop
@section('content')
<div id="page-wrapper">
    <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('dafac.create') }}">New DAFAC</a>
            </li>
    </ol>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Encoded DAFAC</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dafac_table" style="font-size: 12px;">
                  <thead >
                    <tr>
                        <th>Serial No</th>
                        <th>Province</th>
                        <th>City/Municipality</th>
                        <th>Barangay</th>
                        <th>Evacuation Site</th>
                        <th>Head of the Family</th>
                        <th>Date Registered</th>
                        <th>Encoded By</th>
                        <th width="50px"></th>
                        @if(Auth::user()->is_admin == 1)
                        <th width="50px"></th>
                        @endif
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach($dafac as $dafac)
                    <tr class="odd gradeX">
                        <td>{{ $dafac->id }}</td>
                        <td>{{ $dafac->prov_name }}</td>
                        <td>{{ $dafac->city_name }}</td>  
                        <td>{{ $dafac->brgy_name }}</td>
                        <td>{{ $dafac->evacuation_site }}</td>
                        <td>{{ $dafac->last_name . ', ' . $dafac->first_name . ' ' . $dafac->middle_name }} </td>
                        <td>{{ $dafac->date_registered }}</td>
                        <td>{{ $dafac->name }}</td>
                        <td width="80"><a href="{{ route('dafac.show', $dafac->id) }}" class="btn btn-primary">View</a></td>
                        @if(Auth::user()->is_admin == 1)
                        <td width="80"><a href="#" class="btn btn-danger btnDelete">Delete</a></td>
                        @endif 
                    </tr>   
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
@endsection

@section('scripts')
<script src="{{ asset('DataTables-1.10.13/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('DataTables-1.10.13/media/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
<script>
$('#dafac_table').dataTable({
    
      "order": [],
      "columnDefs": [{
        "targets"  : 'no-sort',
        "orderable": false,
      }]
  });
</script>
<script>
    $('.tbody').on('click', '.btnDelete', function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        var id =$(this).closest('tr').children('td:nth-child(1)').text();
        
        $.confirm({
        title: 'Delete record',
        content: 'Are you sure you want to delete this record?',
        buttons: {
            confirm: function () {
                window.location.href = 'deleteDafac/'+id;
            },
            cancel: function () {    
            },
        }
        });
    });
</script>
@stop