@extends('layouts.main')
@section('stylesheet')
<link href="{{ asset('DataTables-1.10.13/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('css/jquery-confirm.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery-confirm.min.css') }}" rel="stylesheet">
@stop
@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Evacuation Site Libraries</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <div class="row">
      @if (Session::has('success'))
      <div class="alert alert-success" role="alert">
          <strong>Success:</strong>{{ Session::get('success') }}
      </div>
      @elseif (Session::has('edit_success'))
          <div class="alert alert-success" role="alert">
             <strong>Success:</strong>{{ Session::get('edit_success') }}
          </div>
      @elseif (Session::has('delete_success'))
          <div class="alert alert-danger" role="alert">
             <strong>Success:</strong>{{ Session::get('delete_success') }}
          </div>    
      @endif
   </div>
    <div class="row">
               <div class="col-lg-12">
                    <a href="#outgo" data-toggle="modal" class="btn btn-default" data-target="#newEvacSite">Add Library</a>
                </div>                   
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <table width="100%" class="table table-striped table-bordered table-hover" id="evacSiteTable">
                <thead >
                    <tr>
                        <th>ID</th>
                        <th>Name of Evacuation Site</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach($evacSite as $evacSite)
                    <tr class="odd gradeX">
                        <td>{{ $evacSite->id }}</td>
                        <td>{{ $evacSite->evacuation_site }}</td>
                        <td>@if($evacSite->status ==1) Active @else Inactive @endif</td> 
                        <td width="100"><a href="{{ route('evacSite.edit',$evacSite->id) }}" class="btn btn-primary btnEdit">Edit</a></td> 
                        <td width="100"><a href="#" class="btn btn-danger btnDelete">Delete</a></td> 
                    </tr>   
                    @endforeach                      
                </tbody>
            </table>
        </div>
    </div>
      <div class="modal fade" id="newEvacSite">
          <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="">
              <span>&times;</span></button>
              <h4>Add new Library</h4>
          </div>
          <div class="modal-body">
                  <form data-toggle="validator" class = "form-horizontal" method="POST" action="{{ route('evacSite.store')}}">
                   {{ csrf_field() }}
                      <div class="form-group">  
                            <label class="col-lg-4 control-label">Name of Evacuation Site</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="evacuation_site" id="evacuation_site" required autofocus>
                            </div>
                      </div>
                      <div class="row">
                          <div class="col-xs-6 col-md-6">
                              <input type="submit" name ="btnSave" value="Save" class="btn btn-success btn-block btn-md"> 
                          </div>

                      </div>  
                  </form> 
              </div>
          </div>
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
$('#evacSiteTable').dataTable({
    
      "order": [],
      "columnDefs": [ {
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
                window.location.href = 'deleteEvacSite/'+id;
            },
            cancel: function () {    
            },
        }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.btnEdit').on('click', function(){
            var id = $(this).closest('tr').children('td:nth-child(1)').text();
            var type_of_insurance = $(this).closest('tr').children('td:nth-child(2)').text();
            $('#editModalID').val(id);
            $('#editModalType').val(type_of_insurance);
        });
    });
</script>
@stop