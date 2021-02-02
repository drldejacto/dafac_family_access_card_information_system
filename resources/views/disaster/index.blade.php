@extends('layouts.admin')
@section('content')
@can('division_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("disaster.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.disaster.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.disaster.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Disasgter">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.disaster.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.disaster.fields.name_of_disaster') }}
                        </th>
                         <th>
                            {{ trans('cruds.disaster.fields.code') }}
                        </th>
                         <th>
                            {{ trans('cruds.disaster.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.disaster.fields.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.disaster.fields.updated_at') }}
                        </th>
                        <th width="150">
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($disaster as $key => $dis)
                        <tr data-entry-id="{{ $dis->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $dis->id ?? '' }}
                            </td>
                            <td>
                                {{ $dis->name_of_disaster ?? '' }}
                            </td>
                            <td>
                                {{ $dis->code ?? '' }}
                            </td>
                            <td>
                                @if($dis->status == 1) Active @else Inactive @endif
                            </td>
                            <td>
                                {{ $dis->created_at ?? '' }}
                            </td>
                            <td>
                                {{ $dis->updated_at ?? '' }}
                            </td>
                            <td>
                                @can('disaster_libraries')
                                    <a class="btn btn-xs btn-primary" href="{{ route('disaster.show', $dis->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('disaster_libraries')
                                    <a class="btn btn-xs btn-info" href="{{ route('disaster.edit', $dis->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('disaster_libraries')
                                    <form action="{{ route('disaster.destroy', $dis->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('division_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('disaster.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Disasgter:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection