<table class="table table-responsive table-striped table-bordered table-hover" id="pins-table">
    <thead>
    {{--<th>ID</th>--}}
    <th>{!! trans("pin.avatar") !!}</th>
    <th>{!! trans("pin.name") !!}</th>
    <th>{!! trans("pin.point") !!}</th>
    <th>{!! trans("app.status") !!}</th>
    <th>{!! trans("app.created_at") !!}</th>
    <th>{!! trans("app.detail") !!}</th>
    <th>{!! trans("app.edit") !!}</th>
    <th>{!! trans("app.delete") !!}</th>
    </thead>
    <tbody>
    @foreach($pins as $pin)
        <tr>
            {{--<td>{!! $pin->id !!}</td>--}}
            <td><?php echo Html::image($pin->avatar, '', ['style' => 'width:19px; height:19px']) ?></td>
            <td>{!! $pin->name !!}</td>
            <td>{!! $pin->point !!}</td>
            <td>{!! \App\Models\BaseModel::getStatusName($pin->status) !!}</td>
            <td>{!! $pin->created_at !!}</td>
            <td>
                <a href="{!! route('backend.pins.show', [$pin->id]) !!}" class='btn btn-default btn-xs'><i
                            class="glyphicon glyphicon-eye-open"></i></a>
            </td>
            <td>
                <a href="{!! route('backend.pins.edit', [$pin->id]) !!}" class='btn btn-default btn-xs'><i
                            class="glyphicon glyphicon-edit"></i></a>
            </td>
            <td>
                {!! Form::open(['route' => ['backend.pins.destroy', $pin->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $pins->appends(['start_time'=>$start_time, 'end_time'=>$end_time, 'status'=>$status])->render() !!}