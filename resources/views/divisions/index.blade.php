@extends('layouts.admin')
@section('content')
@can('division_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("divisions.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.division.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.division.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Division">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.division.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.division.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.division.fields.supervisor') }}
                        </th>
                        <th>
                            {{ trans('cruds.division.fields.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.division.fields.updated_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($divisions as $key => $division)
                        <tr data-entry-id="{{ $division->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $division->id ?? '' }}
                            </td>
                            <td>
                                {{ $division->description ?? '' }}
                            </td>
                            <td>
                                {{ $division->supervisor->last_name . ', ' . $division->supervisor->first_name ?? '' }}
                            </td>
                            <td>
                                {{ $division->created_at ?? '' }}
                            </td>
                            <td>
                                {{ $division->updated_at ?? '' }}
                            </td>
                            <td>
                                @can('division_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('divisions.show', $division->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('division_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('divisions.edit', $division->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('division_delete')
                                    <form action="{{ route('divisions.destroy', $division->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('divisions.massDestroy') }}",
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
  $('.datatable-Division:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection