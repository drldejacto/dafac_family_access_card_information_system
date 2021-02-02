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
            <a href="#"> <i class="glyphicon glyphicon-user"></i> Search DAFAC</a>
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
                <form data-toggle="validator" method="POST" action="{{ route('dafac.update', $dafac->getOriginal('id')) }}"> 
                {{ csrf_field() }}
                {{ method_field('PATCH') }}  
                    <div class="row">
                      <div class="form-group">
                            <label class="col-lg-2 control-label">Province</label>
                            <div class="col-lg-4">
                                <Select class ="form-control" id="prov_code" class="form-control" name="prov_code" required autofocus>
                                    <option value="072200000">CEBU</option>
                                </Select>
                            </div>
                            <label class="col-lg-2 control-label">City/Municipality</label>
                            <div class="col-lg-4">
                                <Select class ="form-control" id="city_code" class="form-control" name="city_code" required autofocus>
                                    <option value = "072234000">CITY OF NAGA</option>
                                </Select>
                            </div>
                      </div>
                    </div>
                   <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Barangay</label>
                            <div class="col-lg-4">
                                <Select class ="form-control" id="brgy_code" class="form-control" name="brgy_code" autofocus>
                                    <option value ="" >-Please Select-</option>
                                    @foreach($brgys as $brgy)
                                     <option value ="{{ $brgy->brgy_code }}" @if($brgy->brgy_code == $dafac->brgy_code) selected @endif>{{ $brgy->brgy_name }}</option>
                                    @endforeach
                                </Select>
                            </div>
                            <label class="col-lg-2 control-label">Date Registered</label>
                            <div class="input-group date col-lg-3" data-provide="datepicker" style="padding-left: 15px;">
                              <input type="date" class="form-control" id="date_registered" value ="{{ $dafac->date_registered }}" name="date_registered" autofocus>
                              <div class="input-group-addon">
                                  <span class="glyphicon glyphicon-th"></span>
                              </div>
                          </div>
                      </div>
                    </div>
                   <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Evacuation Site</label>
                            <div class="col-lg-4">
                                <Select class ="form-control" id="evac_site" class="form-control" name="evac_site" autofocus required>
                                    @foreach($evacSite as $evac)
                                     <option value="{{ $evac->id }}" @if($dafac->evac_site_id == $evac->id) selected @endif>{{$evac->evacuation_site}}</option>
                                     @endforeach
                                </Select>
                            </div>
                            <label class="col-lg-2 control-label">Pantawid</label>
                            <div class="col-lg-4">
                                <Select class ="form-control" id="pantawid" class="form-control" name="pantawid" required autofocus>
                                    <option>-Please Select-</option>
                                    <option value = "1" @if($dafac->pantawid == 1) selected @endif>1 - Yes</option>
                                    <option value = "2" @if($dafac->pantawid == 2) selected @endif>2 - No</option>
                                </Select>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Is Indigenous</label>
                            <div class="col-lg-4">
                                <Select class ="form-control" id="is_indigenous" class="form-control" name="is_indigenous" onchange="myFunction()" required autofocus>
                                    <option>-Please Select-</option>
                                    <option value = "1" @if($dafac->is_indigenous == 1) selected @endif>1 - Yes</option>
                                    <option value = "2" @if($dafac->is_indigenous == 2) selected @endif>2 - No</option>
                                </Select>
                            </div>
                            <label class="col-lg-2 control-label" disabled>Type of Ethnicity</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" id ="type_of_ip" name = "type_of_ip" value="{{ $dafac->type_of_ip }}" disabled>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Housing Condition</label>
                            <div class="col-lg-4">
                                <Select class ="form-control" id="housing_condition" class="form-control" name="housing_condition" autofocus>
                                    <option value="0">-Please Select-</option>
                                    <option value = "1" @if($dafac->housing_condition == 1) selected @endif >1 - Partially Damage</option>
                                    <option value = "2" @if($dafac->housing_condition == 2) selected @endif >2 - Totally Damage</option>
                                    <option value = "3" @if($dafac->housing_condition == 3) selected @endif >3 - No Damage</option>
                                </Select>
                            </div>
                            <label class="col-lg-2 control-label">Tenure Status</label>
                            <div class="col-lg-4">
                                <Select class ="form-control" id="tenure_status" class="form-control" name="tenure_status" autofocus>
                                    <option value="0" >-Please Select-</option>
                                    <option value = "1" @if($dafac->tenure_status == 1) selected @endif>1 - House & Lot Owner</option>
                                    <option value = "2" @if($dafac->tenure_status == 2) selected @endif>2 - Rented House & Lot</option>
                                    <option value = "3" @if($dafac->tenure_status == 3) selected @endif>3 - House owner & Lot renter</option>
                                    <option value = "4" @if($dafac->tenure_status == 4) selected @endif>4 - House owner, rent-free lot with owner's consent</option>
                                    <option value = "5" @if($dafac->tenure_status == 5) selected @endif>5 - House owner, rent-free lot w/o consent of the owner</option>
                                    <option value = "6" @if($dafac->tenure_status == 6) selected @endif>6 - Rent-free house & lot with owner's consent</option>
                                    <option value = "7" @if($dafac->tenure_status == 7) selected @endif>7 - Rent-free house & lot w/o owner's consent</option>
                                </Select>
                            </div>
                      </div>
                    </div>
                     <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Name of LSWDO</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" name = "name_of_lswdo" value ="{{ $dafac->name_of_lswdo }}" autofocus>
                            </div>
                            <label class="col-lg-2 control-label">Name of Barangay Captain</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" name = "name_of_brgy_captain" value ="{{ $dafac->name_of_brgy_captain }}" autofocus>
                            </div>
                      </div>
                    </div> 
                    @if(Auth::user()->is_admin == 1) 
                    <div class="row">
                    <div class="form-group">
                            <label class="col-lg-2 control-label">Barangay Validation</label>
                            <div class="col-lg-4">
                                <Select class ="form-control" id="is_affected" class="form-control" name="is_affected" autofocus>
                                    <option value=""> - Please Select - </option>
                                    <option value="1" @if($dafac->is_affected == 1) selected @endif>1 - Directly Affected</option>
                                    <option value="2" @if($dafac->is_affected == 2) selected @endif>2 - Indirectly Afected(forcely evacuated)</option>
                                    <option value="3" @if($dafac->is_affected == 3) selected @endif>3 - Not Affected</option>
                                </Select>
                            </div>
                  
                    </div>
                    </div>
                    @endif
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
<script type="text/javascript">
  function myFunction(){
    var is_indigenous = $('#is_indigenous').val();
    if(is_indigenous == 1){
      $('#type_of_ip').removeAttr("disabled");
    }else
    {
      $('#type_of_ip').prop('disabled','disabled');
    }
  }
</script>
@stop