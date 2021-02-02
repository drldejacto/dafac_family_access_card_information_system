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
              <form data-toggle="validator" method="POST" action="{{ route('roster.update', $roster->id) }}"> 
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
                                <input type="input" class="form-control" id="first_name" name="first_name" value="{{$roster->first_name}}" autofocus>
                            </div>
                            <label class="col-lg-2 control-label">Middle Name</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" id="midle_name" name="middle_name" value="{{$roster->middle_name}}" autofocus>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Last Name</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" id="last_name" name="last_name" value="{{$roster->last_name}}" autofocus>
                            </div>
                            <label class="col-lg-2 control-label">Relationship to HH Head</label>
                            <div class="col-lg-4">
                                <Select class ="form-control" id="relationship_to_hh_head" class="form-control" name="relationship_to_hh_head" autofocus>
                                    <option value="0">-Please Select-</option>
                                    @foreach($relationships  as $rel)
                                    <option value="{{ $rel->id }}" @if($roster->relationship_to_hh_head == $rel->id) selected @endif >{{ $rel->relationship_to_hh_head }}</option>
                                    @endforeach
                                </Select>
                            </div>
                      </div>
                    </div>
                   <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Birthday</label>
                            <div class="col-lg-4">
                                <input type="date" class="form-control" name ="birthday" value="{{ $roster->birthday }}">
                            </div>
                            <label class="col-lg-2 control-label">Age in Years</label>
                            <div class="col-lg-4">
                                <input type="number" class="form-control" name ="age_in_years" value="{{$roster->age_in_years}}">
                            </div>
                      </div>
                    </div>
                    <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Age in Months</label>
                            <div class="col-lg-4">
                                <input type="number" class="form-control" name ="age_in_months" value="{{$roster->age_in_months}}">
                            </div>
                            <label class="col-lg-2 control-label">Gender</label>
                            <div class="col-lg-4">
                                <Select class ="form-control" id="gender" class="form-control" name="gender" autofocus>
                                    <option value="0">-Please Select-</option>
                                    <option value="1" @if($roster->gender == 1) selected @endif >MALE</option>
                                    <option value="2" @if($roster->gender == 2) selected @endif >FEMALE</option>
                                </Select>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Educational Attainment</label>
                            <div class="col-lg-4">
                                <Select class ="form-control" id="educ_attain" class="form-control" name="educ_attain" autofocus>
                                    <option value="20">-Please Select-</option>
                                    @foreach($education as $education)
                                    <option value="{{ $education->id }}" @if($roster->educ_attain == $education->id) selected @endif >{{ $education->educ_attain }}</option>
                                    @endforeach
                                </Select>
                            </div>
                            <label class="col-lg-2 control-label">Occupational Skill</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" name="occupational_skills" value="{{ $roster->occupational_skills }}" autofocus>
                            </div>
                      </div>
                    </div>
                     <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Monthly Income</label>
                            <div class="col-lg-4">
                                <input type="number" class="form-control" value="{{ $roster->monthly_net_income }}" name="monthly_net_income" autofocus>
                            </div>
                            <label class="col-lg-2 control-label">Health Condition</label>
                            <div class="col-lg-4">
                                <Select class ="form-control" id="health_condition" class="form-control" name="health_condition" autofocus>
                                    <option value="">-Please Select-</option>
                                    @foreach($hc as $hc)
                                    <option value="{{ $hc->id }}" @if($hc->id == $roster->health_condition) selected @endif> {{ $hc->health_condition}}</option>
                                    @endforeach
                                </Select>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Vulnerability</label>
                            <div class="col-lg-4">
                                <Select class ="form-control" id="vulnerability" class="form-control" name="vulnerability" autofocus>
                                    <option value="">-Please Select-</option>
                                    @foreach($vul as $vul)
                                    <option value="{{ $vul->id }}" @if($vul->id == $roster->vulnerability) selected @endif> {{ $vul->vulnerability}}</option>
                                    @endforeach
                                </Select>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-5 col-md-5 col-md-offset-5">
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