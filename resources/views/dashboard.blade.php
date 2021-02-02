@extends('layouts.admin')

@section('title', 'DAFAC-IS')

@section('content_header')

@section('content')
<div class="row">
        <div class="col-sm-12">
            <div class="card card-success">
               <div class="card-header">
                  <h3 class="card-title">City of Naga, Cebu Landslide Evacuation Data</h3>
               </div>
               
               <hr>
                <div class="card-body" id="account_profile">
                   <form class="form-horizontal">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dashboard">
                          <thead >
                              <tr>
                                  <th style="text-align:center">Barangay</th>
                                  <th style="text-align:center">Partially Damage</th>
                                  <th style="text-align:center">Totally Damage</th>
                                  <th style="text-align:center">No Damage</th>
                                  <th style="text-align:center">No Entry</th>
                              </tr>
                          </thead>
                          <tbody> 
                                @foreach($housing_condition as $hc)
                                 <tr>   
                                    <td>{{ $hc->brgy_name }}</td>
                                    <td>{{ $hc->partially_damage }}</td>
                                    <td>{{ $hc->totally_damage }}</td>
                                    <td>{{ $hc->no_damage }}</td>
                                    <td>{{ $hc->no_data }}</td>
                                 </tr> 
                                 @endforeach            
                          </tbody>
                        </table>
                  </form>
              </div>
                 
            </div><!-- end card body -->
        </div>
        
      </div>
@endsection
@section('adminlte_js')

<script>
$('.table').dataTable({
    
      "order": [],
      "columnDefs": [{
        "targets"  : 'no-sort',
        "orderable": false,
      }]
  });
</script>   
@stop
