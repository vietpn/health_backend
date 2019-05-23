<table class="table table-responsive table-striped table-bordered table-hover" id="rankConfigs-table">
    <thead>
        <th>Name</th>
        <th>Begin</th>
        <th>End</th>
        <th>Time</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($rankConfigs as $rankConfig)
        <tr>
            <td>{!! $rankConfig->name !!}</td>
            <td>{!! $rankConfig->begin !!}</td>
            <td>{!! $rankConfig->end !!}</td>
            <td>{!! $rankConfig->time !!}</td>
            <td>{!! $rankConfig->created_at !!}</td>
            <td>{!! $rankConfig->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.rankConfigs.destroy', $rankConfig->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.rankConfigs.show', [$rankConfig->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.rankConfigs.edit', [$rankConfig->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>