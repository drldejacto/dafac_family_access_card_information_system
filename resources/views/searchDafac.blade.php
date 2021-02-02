@extends('layouts.main')
@section('stylesheet')
<style>
.row{
  padding-top: 5px; 
}
</style>
@stop
@section('content')
<div id="page-wrapper">
  <div class="container-fluid">

    <ol class="breadcrumb">
            <li class="breadcrumb-item">
              
            </li>
    </ol>
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
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4>Search DAFAC</h4>
          </div>
          <div class="panel-body">
            <form method="GET" action="search" accept-charset="UTF-8">
            <div id="custom-search-input">
                <div class="input-group col-md-6">
                    <input  type="text" class="form-control input-lg" name="serial_no" placeholder="Enter Serial Number" />
                    <span class="input-group-btn">
                        <button  class="btn btn-info btn-lg" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
            </form>
          </div>
        </div>
     </div>
  </div>   
</div>
    <!-- /#page-wrapper -->
@endsection
@section('scripts')
@stop