<table class="table table-responsive table-striped table-bordered table-hover" id="profileBlocks-table">
    <thead>
        <th>Profile Id</th>
        <th>Profile Name</th>
        <th>Profile Id Block</th>
        <th>Profile Block Name</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($profileBlocks as $profileBlock)
        <tr>
            <td>{!! $profileBlock->profile_id !!}</td>
            <td>{!! $profileBlock->profile_name !!}</td>
            <td>{!! $profileBlock->profile_id_block !!}</td>
            <td>{!! $profileBlock->profile_block_name !!}</td>
            <td>{!! $profileBlock->created_at !!}</td>
            <td>{!! $profileBlock->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.profileBlocks.destroy', $profileBlock->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.profileBlocks.show', [$profileBlock->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>