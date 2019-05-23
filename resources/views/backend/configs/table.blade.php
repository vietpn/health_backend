<table class="table table-responsive table-striped table-bordered table-hover" id="configs-table">
    <thead>
        <th>{!! trans('app.key') !!}</th>
        <th>{!! trans('app.value') !!}</th>
        <th>{!! trans('app.description') !!}</th>
        <th>{!! trans('app.status') !!}</th>
        <th colspan="3">{!! trans('app.action') !!}</th>
    </thead>
    <tbody>
    @foreach($configs as $config)
        <tr>
            <td>{!! $config->key !!}</td>
            <td>{!! $config->value !!}</td>
            <td>{!! $config->describe !!}</td>
            <td>{!! \App\Models\BaseModel::getStatusName($config->status) !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.configs.destroy', $config->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.configs.show', [$config->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.configs.edit', [$config->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>