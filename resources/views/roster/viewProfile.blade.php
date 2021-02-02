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
       <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('dafac.show',$roster->serial_no) }}">View DAFAC</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ route('roster.show',$roster->serial_no) }}">Family Roster</a>
            </li>.
            <li class="breadcrumb-item">
              <a href="#">Family Assistance Record</a>
            </li>
    </ol>
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
            <h4>View Profile</h4>
          </div>
          <div class="panel-body">
              <form data-toggle="validator" method="POST" action="#"> 
                {{ csrf_field() }}
                {{ method_field('PATCH') }}  
                   <div class="row">
                      <div class="form-group">
                            <label class="col-lg-2 control-label">Serial No</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" id="id" name= "serial_no" value="{{ $roster->serial_no }}" disabled>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group">
                            <label class="col-lg-2 control-label">First Name</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" id="first_name" name="first_name" value="{{$roster->first_name}}" disabled>
                            </div>
                            <label class="col-lg-2 control-label">Middle Name</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" id="midle_name" name="midle_name" value="{{$roster->middle_name}}" disabled>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Last Name</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" id="last_name" name="last_name" value="{{$roster->last_name}}" disabled>
                            </div>
                            <label class="col-lg-2 control-label">Relationship to HH Head</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" id="relationship_to_hh_head" name="relationship_to_hh_head" value="{{$roster->rel_to_hh->relationship_to_hh_head}}" disabled>
                            </div>
                      </div>
                    </div>
                   <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Birthday</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" value="{{ $roster->birthday }}" disabled>
                            </div>
                            <label class="col-lg-2 control-label">Age in Years</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" value="{{$roster->age_in_years}}" disabled>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Age in Months</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" value="{{$roster->age_in_months}}" disabled>
                            </div>
                            <label class="col-lg-2 control-label">Gender</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" value="{{ $roster->gender }}" disabled>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Educational Attainment</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" value="{{ $roster->education->educ_attain }}" disabled>
                            </div>
                            <label class="col-lg-2 control-label">Occupational Skill</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" value="{{ $roster->occupational_skills }}" disabled>
                            </div>
                      </div>
                    </div>
                     <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Monthly Income</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" value="{{ $roster->mothly_net_income }}" disabled>
                            </div>
                            <label class="col-lg-2 control-label">Health Condition</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" value="@if($roster->health_condition <> null) {{ $roster->rosterHealthCondition->health_condition }} @endif" disabled>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Vulnerability</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" value="@if($roster->vulnerability <> null) {{$roster->rosterVulnerability->vulnerability}} @endif" disabled>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-5 col-md-5 col-md-offset-5">
                          <a href="{{ route('roster.edit', $roster->getOriginal('id')) }}"  class="btn btn-primary" style="width:20em;">Edit</a>
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