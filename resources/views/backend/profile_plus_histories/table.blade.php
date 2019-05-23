<table class="table table-responsive table-striped table-bordered table-hover" id="profilePlusHistories-table">
    <thead>
        <th>Profile Id</th>
        <th>Point</th>
        <th>Type</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($profilePlusHistories as $profilePlusHistory)
        <tr>
            <td>{!! $profilePlusHistory->profile_id !!}</td>
            <td>{!! $profilePlusHistory->point !!}</td>
            <td>{!! $profilePlusHistory->type !!}</td>
            <td>{!! $profilePlusHistory->created_at !!}</td>
            <td>{!! $profilePlusHistory->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.profilePlusHistories.destroy', $profilePlusHistory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.profilePlusHistories.show', [$profilePlusHistory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.profilePlusHistories.edit', [$profilePlusHistory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>