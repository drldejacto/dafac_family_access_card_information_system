@extends('adminlte::page')

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
                                  <th style="text-align:center">Male</th>
                                  <th style="text-align:center">Female</th>
                              </tr>
                          </thead>
                          <tbody> 
                                @foreach($individual as $indi)
                                 <tr>   
                                    <td>{{ $indi->brgy_name }}</td>
                                    <td>{{ $indi->male }}</td>
                                    <td>{{ $indi->female }}</td>
                                 </tr> 
                                 @endforeach            
                          </tbody>
                        </table>
                  </form>
              </div>
              <div class="card-footer">
                  Date Encoded: September 28 to October 5, 2020
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
