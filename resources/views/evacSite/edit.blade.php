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
        <li class="active">
            <a href="{{ route('evacSite.index') }}">Evacuation Site Libraries</a>
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
            <h4>New DAFAC</h4>
          </div>
          <div class="panel-body">
                <form data-toggle="validator" method="POST" action="{{ route('evacSite.update', $evacSite->getOriginal('id')) }}"> 
                {{ csrf_field() }}
                {{ method_field('PATCH') }}  
                    <div class="row">
                      <div class="form-group">
                            <label class="col-lg-2 control-label">Evacuation Site</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" name = "evacuation_site" value ="{{ $evacSite->evacuation_site }}" autofocus>
                            </div>
                      </div>
                    </div>
                  
                    <div class="row">
                    <div class="col-xs-4 col-md-4 col-md-offset-4">
                        <input type="submit" name ="btnSave" value="Save Changes" class="btn btn-primary btn-block btn-md"> 
                    </div>
                </div> 
              </form>         
          </div>
        </div>
     </div>
    
      
      </form>
  </div>   
</div>
    <!-- /#page-wrapper -->
@endsection
@section('scripts')
@stop