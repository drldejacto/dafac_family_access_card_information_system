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
              <a href="{{ route('dafac.create') }}">New DAFAC</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ route('roster.show',$dafac->getOriginal('id')) }}">Family Roster</a>
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
            <h4>New DAFAC</h4>
          </div>
          <div class="panel-body">
              <form data-toggle="validator" method="POST" action="#"> 
                {{ csrf_field() }}
                {{ method_field('PATCH') }}  
                   <div class="row">
                      <div class="form-group">
                            <label class="col-lg-2 control-label">Serial No</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" id="id" name= "serial_no" value="{{ $dafac->getOriginal('id') }}" disabled>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group">
                            <label class="col-lg-2 control-label">Province</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" id="prov_code" name="prov_code" value="CEBU" disabled>
                            </div>
                            <label class="col-lg-2 control-label">City/Municipality</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" id="city_code" name="city_code" value="CITY OF NAGA" disabled>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Barangay</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" id="brgy_code" name="brgy_code" @if($dafac->brgy_code <> null) value="{{ $dafac->barangay->brgy_name }}"@endif disabled>
                            </div>
                            <label class="col-lg-2 control-label">Date Registered</label>
                            <div class="input-group date col-lg-3" data-provide="datepicker" style="padding-left: 15px;">
                              <input type="input" class="form-control" value="{{ $dafac->date_registered }}" disabled>
                          </div>
                      </div>
                    </div>
                   <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Evacuation Site</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" value="{{ $dafac->evacSite->evacuation_site }}" disabled>
                            </div>
                            <label class="col-lg-2 control-label">Pantawid</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" value="@if($dafac->pantawid ==1) Yes @else No @endif" disabled>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Is Indigenous</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" value="@if($dafac->is_indigenous ==1) Yes @else No @endif" disabled>
                            </div>
                            <label class="col-lg-2 control-label" disabled>Type of Ethnicity</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" value="{{ $dafac->type_of_ip }}" disabled>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Housing Condition</label>
                            <div class="col-lg-4">
                                <Select class ="form-control" id="housing_condition" class="form-control" name="housing_condition" disabled autofocus>
                                    <option>-Please Select-</option>
                                    <option value = "1" @if($dafac->housing_condition == 1) selected @endif >1 - Partially Damaged</option>
                                    <option value = "2" @if($dafac->housing_condition == 2) selected @endif >2 - Totally Damaged</option>
                                    <option value = "2" @if($dafac->housing_condition == 3) selected @endif >3 - No Damage</option>
                                </Select>
                            </div>
                            <label class="col-lg-2 control-label">Tenure Status</label>
                            <div class="col-lg-4">
                                <Select class ="form-control" id="tenure_status" class="form-control" name="tenure_status" disabled autofocus>
                                    <option>-Please Select-</option>
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
                                <input type="input" class="form-control" value ="{{ $dafac->name_of_lswdo }}" disabled autofocus>
                            </div>
                            <label class="col-lg-2 control-label">Name of Barangay Captain</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" value ="{{ $dafac->name_of_brgy_captain }}" disabled autofocus>
                            </div>
                      </div>
                    </div>
                    <div class="row">
                     <div class="form-group">
                            <label class="col-lg-2 control-label">Barangay Validation</label>
                            <div class="col-lg-4">
                                <input type="input" class="form-control" value ="@if($dafac->is_affected == 1) 1 - Directly Affected @elseif($dafac->is_affected == 2) 2 - Indirectly Affected @elseif($dafac->is_affected == 3) 3 - Not Affected @else  @endif" disabled autofocus>
                            </div>
                            
                      </div>
                    </div>    
                    <div class="row">
                      <div class="col-xs-5 col-md-5 col-md-offset-5">
                          <a href="{{ route('dafac.edit', $dafac->getOriginal('id')) }}"  class="btn btn-primary" style="width:20em;">Edit</a>
                      </div>
                   </div> 
                   <div class="row">
                      <div class="col-xs-5 col-md-5 col-md-offset-5">
                          <a href="{{ route('roster.show', $dafac->getOriginal('id')) }}"  class="btn btn-primary" style="width:20em;">Family Roster</a>
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