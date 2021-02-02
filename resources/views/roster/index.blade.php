@extends('layouts.main')
@section('stylesheet')
<link href="{{ asset('css/jquery-confirm.min.css') }}" rel="stylesheet">
@stop
@section('content')
<div id="page-wrapper">
    <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{ route('dafac.show',$dafac->getOriginal('id')) }}">Back to DAFAC</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ route('roster.show',$dafac->getOriginal('id')) }}">Family Roster</a>
            <li class="breadcrumb-item">
              <a href="#">Family Assistance Record</a>
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
          </div>f
      @elseif (Session::has('delete_success'))
          <div class="alert alert-danger" role="alert"> 
             <strong>Success:</strong>{{ Session::get('delete_success') }}
          </div>    
      @endif
   </div>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Family Roster</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <br>
    <div class="row">
         <div class="col-lg-12">
              <a href="#outgo" data-toggle="modal" class="btn btn-default" data-target="#addRoster" autofocus>Add Roster</a>
          </div>                   
    </div>
     <br>
    <div class="row">
        <div class="col-lg-12">
            <table width="100%" class="table table-striped table-bordered table-hover" id="roster_table" style="font-size: 12px;">
                  <thead >
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Rel to HH</th>
                        <th>Birthday</th>
                        <th>Age in Years</th>
                        <th>Age in Months</th>
                        <th>Gender</th>
                        <th>Educ Attainment</th>
                        <th>Occupational Skills</th>
                        <th>Monthly Income</th>
                        <th>Health Condition</th>
                        <th>Vulnerability</th>
                        <th width="50px"></th>
                        <th width="50px"></th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach($rosters as $roster)
                    <tr class="odd gradeX">
                        <td>{{ $roster->id }}</td>
                        <td>{{ $roster->first_name }}</td>
                        <td>{{ $roster->middle_name}}</td>
                        <td>{{ $roster->last_name }}</td>  
                        <td>{{ $roster->rel_to_hh->relationship_to_hh_head }}</td>
                        <td>{{ $roster->birthday }}</td>
                        <td>{{ $roster->age_in_years }}</td>
                        <td>{{ $roster->age_in_months }}</td>
                        <td>{{ $roster->gender }}</td>
                        <td>{{ $roster->education->educ_attain }}</td>
                        <td>{{ $roster->occupational_skills }}</td>
                        <td>{{ $roster->monthly_income }}</td>
                        <td>@if($roster->health_condition <> null) {{ $roster->rosterHealthCondition->health_condition }} @endif</td>
                        <td>@if($roster->vulnerability <> null) {{ $roster->rosterVulnerability->vulnerability }} @endif</td>
                        <td width="80"><a href="{{ route('roster.viewProfile',$roster->id)}}" class="btn btn-primary">View</a></td>
                        <td width="80"><a href="#" class="btn btn-danger btnDelete">Delete</a></td> 
                    </tr>   
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.row -->
</div>
<div class="modal fade" id="addRoster" style="font-size: 12px;">
          <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="">
              <span>&times;</span></button>
              <h4>Add Roster</h4>
          </div>
          <div class="modal-body">
                  <form data-toggle="validator" class = "form-horizontal" method="POST" action="{{ route('roster.store') }}">
                   {{ csrf_field() }}
                     <div class="form-group">
                            <label class="col-lg-4 control-label">Serial No</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="serial_no" value = "{{$dafac->getOriginal('id')}}">
                            </div>
                      </div>
                      <div class="form-group">
                            <label class="col-lg-4 control-label">First Name</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="first_name" placeholder ="First Name" required autofocus>
                            </div>
                      </div>
                      <div class="form-group">
                            <label class="col-lg-4 control-label">Middle Name</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="middle_name" placeholder ="Middle Name" autofocus>
                            </div>
                      </div>
                      <div class="form-group">
                            <label class="col-lg-4 control-label">Last Name</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="last_name" placeholder ="Last Name" required autofocus>
                            </div>
                      </div>
                      <div class="form-group">
                            <label class="col-lg-4 control-label">Relationship to HH Head</label>
                            <div class="col-lg-8">
                                <Select class ="form-control" id="relationship_to_hh_head" class="form-control" name="relationship_to_hh_head" autofocus>
                                    <option value="0">-Please Select-</option>
                                    @foreach($relationships as $relationship)
                                    <option value="{{ $relationship->id }}">{{ $relationship->relationship_to_hh_head }}</option>
                                    @endforeach
                                </Select>
                            </div>
                      </div>
                      <div class="form-group">
                      <label class="col-lg-4 control-label">Birthday</label>
                            <div class="col-lg-8">
                                <input type="date" class="form-control" name="birthday" placeholder ="Birthday" autofocus>
                            </div>
                      </div>
                      <div class="form-group">
                      <label class="col-lg-4 control-label">Age In Years</label>
                            <div class="col-lg-8">
                                <input type="number" class="form-control" name="age_in_years" placeholder ="Age in Years" autofocus>
                            </div>
                      </div>
                     <div class="form-group">
                      <label class="col-lg-4 control-label">Age In Months</label>
                            <div class="col-lg-8">
                                <input type="number" class="form-control" name="age_in_months" placeholder ="Age in Months" autofocus>
                            </div>
                      </div>
                      <div class="form-group">
                      <label class="col-lg-4 control-label">Gender</label>
                            <div class="col-lg-8">
                                <Select class ="form-control" id="gender" class="form-control" name="gender" autofocus>
                                    <option value="0">-Please Select-</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </Select>
                            </div>
                      </div>
                      <div class="form-group">
                      <label class="col-lg-4 control-label">Educational Attainment</label>
                            <div class="col-lg-8">
                                <Select class ="form-control" id="educ_attain" class="form-control" name="educ_attain" autofocus>
                                    <option value="20">-Please Select-</option>
                                     @foreach($education as $educ)
                                     <option value="{{$educ->id}}">{{ $educ->educ_attain }}</option>
                                     @endforeach
                                </Select>
                            </div>
                      </div>
                      <div class="form-group">
                      <label class="col-lg-4 control-label">Occupational Skills</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="occupational_skills" placeholder ="Occupational Skills" autofocus>
                            </div>
                      </div>
                      <div class="form-group">
                      <label class="col-lg-4 control-label">Monthly Net Income</label>
                            <div class="col-lg-8">
                                <input type="number" class="form-control" name="monthly_net_income" value="0" placeholder ="Monthly Net Income" autofocus>
                            </div>
                      </div>
                      <div class="form-group">
                      <label class="col-lg-4 control-label">Health Condition</label>
                            <div class="col-lg-8">
                                <Select class ="form-control" id="health_condition" class="form-control" name="health_condition" autofocus>
                                    <option value="">-Please Select-</option>
                                    <option value="1">1 - Dead</option>
                                    <option value="2">2 - Injured</option>
                                    <option value="3">3 - Missing</option>
                                    <option value="4">4 - With Illnes</option>
                                </Select>
                            </div>
                      </div>
                      <div class="form-group">
                      <label class="col-lg-4 control-label">Vulnerability</label>
                            <div class="col-lg-8">
                               <Select class ="form-control" id="vulnerability" class="form-control" name="vulnerability" autofocus>
                                    <option value="">-Please Select-</option>
                                    <option value="1">1 - Older Person</option>
                                    <option value="2">2 - Lactating Mother</option>
                                    <option value="3">3 - PWD</option>
                                    <option value="4">4 - Pregnant</option>
                                    <option value="5">5 - Solo Parent</option>
                                </Select>
                            </div>
                      </div>
                      <div class="row">
                          <div class="col-xs-6 col-md-6">
                              <input type="submit" name ="btnSave" value="Save" class="btn btn-success btn-block btn-md"> 
                          </div>

                      </div> 
                    </div> 
                  </form> 
              </div>
          </div>
          </div>
      </div> 
<!-- /#page-wrapper -->
@endsection
@section('scripts')
<script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
<script>
    $('.tbody').on('click', '.btnDelete', function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        //var href = $(this).parent().attr('href');
        var id =$(this).closest('tr').children('td:nth-child(1)').text();
        //alert(href)
        
        $.confirm({
        title: 'Delete record',
        content: 'Are you sure you want to delete this record?',
        buttons: {
            confirm: function () {
                window.location.href = '../deleteRoster/'+id;
            },
            cancel: function () {    
            },
        }
        });
    });
</script>
@stop