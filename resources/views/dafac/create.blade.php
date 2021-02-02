@extends('adminlte::page')

@section('title', 'DAFAC-IS')

@section('content_header')

@section('content')
<div class="row">
        <div class="col-sm-12">
            <div class="card card-success">
               <div class="card-header">
                  <h3 class="card-title">DAFAC Data Entry Application</h3>
               </div>
               
               <hr>
                <div class="card-body" id="account_profile">
                        <form class="form-horizontal" data-toggle="validator" method="POST" action="{{ route('dafac.store') }}"> 
                        {{ csrf_field() }}  
                              <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Province</label>
                                      <div class="col-sm-4">
                                          <Select class ="form-control" id="prov_code" class="form-control" name="prov_code" required autofocus>
                                              <option value="072200000">CEBU</option>
                                          </Select>
                                      </div>
                                      <label class="col-sm-2 col-form-label">City/Municipality</label>
                                      <div class="col-sm-4">
                                          <Select class ="form-control" id="city_code" class="form-control" name="city_code" required autofocus>
                                              <option value = "072234000">CITY OF NAGA</option>
                                          </Select>
                                      </div>
                              </div>

                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Barangay</label>
                                      <div class="col-sm-4">
                                          <Select class ="form-control" id="brgy_code" class="form-control" name="brgy_code" autofocus>
                                              <option value ="" >-Please Select-</option>
                                              @foreach($brgys as $brgy)
                                               <option value ="{{ $brgy->brgy_code }}">{{ $brgy->brgy_name }}</option>
                                              @endforeach
                                          </Select>
                                      </div>
                                      <label class="col-sm-2 col-form-label">Date Registered</label>
                                      <div class="input-group date col-sm-3" data-provide="datepicker" style="padding-left: 15px;">
                                        <input type="date" class="form-control" id="date_registered" name="date_registered" autofocus>
                                        <div class="input-group-addon">
                                            <span class="glyphicon glyphicon-th"></span>
                                        </div>
                                    </div>
                              </div>

                             <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Evacuation Site</label>
                                  <div class="col-sm-4">
                                      <Select class ="form-control" id="evac_site" class="form-control" name="evac_site" autofocus required>
                                           <option value ="" >-Please Select-</option>
                                           @foreach($evacSite as $evac)
                                           <option value="{{ $evac->id }}">{{$evac->evacuation_site}}</option>
                                           @endforeach
                                      </Select>
                                  </div>
                                  <label class="col-sm-2 control-label">Pantawid</label>
                                  <div class="col-sm-4">
                                      <Select class ="form-control" id="pantawid" class="form-control" name="pantawid" required autofocus>
                                          <option>-Please Select-</option>
                                          <option value = "1">1 - Yes</option>
                                          <option value = "2">2 - No</option>
                                      </Select>
                                  </div>
                             </div> 

                             <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Is Indigenous</label>
                                  <div class="col-sm-4">
                                      <Select class ="form-control" id="is_indigenous" class="form-control" name="is_indigenous" onchange="myFunction()" required autofocus>
                                          <option>-Please Select-</option>
                                          <option value = "1">1 - Yes</option>
                                          <option value = "2">2 - No</option>
                                      </Select>
                                  </div>
                                  <label class="col-sm-2 col-form-label" disabled>Type of Ethnicity</label>
                                  <div class="col-sm-4">
                                      <Select class ="form-control" id="type_of_ip" class="form-control" name="type_of_ip" disabled autofocus>
                                          <option value ="" >-Please Select-</option>
                                      </Select>
                                  </div>
                              </div>
                              
                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Housing Condition</label>
                                  <div class="col-sm-4">
                                      <Select class ="form-control" id="housing_condition" class="form-control" name="housing_condition" autofocus>
                                          <option value="0">-Please Select-</option>
                                          <option value = "1">1 - Partially Damage</option>
                                          <option value = "2">2 - Totally Damage</option>
                                          <option value = "3">3 - No Damage</option>
                                      </Select>
                                  </div>
                                  <label class="col-sm-2 col-form-label">Tenure Status</label>
                                  <div class="col-sm-4">
                                      <Select class ="form-control" id="tenure_status" class="form-control" name="tenure_status" autofocus>
                                          <option value="0">-Please Select-</option>
                                          <option value = "1">1 - House & Lot Owner</option>
                                          <option value = "2">2 - Rented House & Lot</option>
                                          <option value = "3">3 - House owner & Lot renter</option>
                                          <option value = "4">4 - House owner, rent-free lot with owner's consent</option>
                                          <option value = "5">5 - House owner, rent-free lot w/o consent of the owner</option>
                                          <option value = "6">6 - Rent-free house & lot with owner's consent</option>
                                          <option value = "7">7 - Rent-free house & lot w/o owner's consent</option>
                                      </Select>
                                  </div> 
                              </div>

                              <div class="form-group row">
                                  <label class="col-sm-2 col-form-label">Name of LSWDO</label>
                                  <div class="col-sm-4">
                                      <input type="input" class="form-control" id="name_of_lswdo" name="name_of_lswdo" autofocus>
                                  </div>
                                  <label class="col-sm-2 col-form-label">Name of Barangay Captain</label>
                                  <div class="col-sm-4">
                                      <input type="input" class="form-control" id="name_of_brgy_captain" name="name_of_brgy_captain" autofocus>
                                  </div>
                              </div> 
                              
                              <div class="row">
                              <div class="col-xs-4 col-md-4 col-md-offset-4">
                                  <input type="submit" name ="btnSave" id = "btnSave" value="Save" class="btn btn-success btn-block btn-md"> 
                              </div>
                             </div>    
                         </form> 
              </div>
                 
            </div><!-- end card body -->
    </div>
        
</div>
@endsection
@section('adminlte_js')
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