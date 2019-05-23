<table class="table table-responsive table-striped table-bordered table-hover" id="pointConfigs-table">
    <thead>
        <th>{!! trans('app.key') !!}</th>
        <th>{!! trans('app.point') !!}</th>
        <th>{!! trans('app.description') !!}</th>
        <th>{!! trans('app.status') !!}</th>
        <th colspan="3">{!! trans('app.action') !!}</th>
    </thead>
    <tbody>
    @foreach($pointConfigs as $pointConfig)
        <tr>
            <td>{!! $pointConfig->key !!}</td>
            <td>{!! $pointConfig->point !!}</td>
            <td>{!! $pointConfig->describe !!}</td>
            <td>{!! \App\Models\BaseModel::getStatusName($pointConfig->status) !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.pointConfigs.destroy', $pointConfig->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.pointConfigs.show', [$pointConfig->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.pointConfigs.edit', [$pointConfig->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>