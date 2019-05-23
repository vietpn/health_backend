<table class="table table-responsive table-striped table-bordered table-hover" id="chargePoints-table">
    <thead>
        <th>Value</th>
        <th>Exchange</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($chargePoints as $chargePoint)
        <tr>
            <td>{!! $chargePoint->value !!}</td>
            <td>{!! $chargePoint->exchange !!}</td>
            <td>{!! $chargePoint->status !!}</td>
            <td>{!! $chargePoint->created_at !!}</td>
            <td>{!! $chargePoint->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.chargePoints.destroy', $chargePoint->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.chargePoints.show', [$chargePoint->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.chargePoints.edit', [$chargePoint->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>