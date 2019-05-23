<table class="table table-responsive table-striped table-bordered table-hover" id="items-table">
    <thead>
        <th>ID</th>
        <th>{!! trans('app.avatar') !!}</th>
        <th>{!! trans('app.name') !!}</th>
        <th>{!! trans('app.point') !!}</th>
        <th>{!! trans('app.category') !!}</th>
        <th>{!! trans('app.position') !!}</th>
        <th>{!! trans('app.is_set') !!}</th>
        <th>{!! trans('app.status') !!}</th>
        <th>{!! trans('app.created_at') !!}</th>
        <th colspan="3">{!! trans('app.action') !!}</th>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{!! $item->id !!}</td>
            <td><?php echo Html::image(\App\Models\BaseModel::getImage( $item->avatar) , '',['style' => 'width:80px; height:80px']) ?></td>
            <td>{!! $item->name !!}</td>
            <td>{!! $item->point !!}</td>
            <td>{!! isset($item->category)? $item->category->title : '' !!}</td>
            <td>{!! \App\Models\BaseModel::getPositionName($item->position) !!}</td>
            <td>{!! $item->is_set !!}</td>
            <td>{!! \App\Models\BaseModel::getStatusName($item->status) !!}</td>
            <td>{!! $item->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.items.destroy', $item->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.items.show', [$item->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.items.edit', [$item->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>