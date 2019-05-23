<table class="table table-responsive table-striped table-bordered table-hover" id="bussinesTypes-table">
    <thead>
        <th>ID</th>
        <th>Title</th>
        <th>Status</th>
        <th>Created At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($bussinesTypes as $bussinesType)
        <tr>
            <td>{!! $bussinesType->id !!}</td>
            <td>{!! $bussinesType->title !!}</td>
            <td>{!! \App\Models\BaseModel::getStatusName($bussinesType->status) !!}</td>
            <td>{!! $bussinesType->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.bussinesTypes.destroy', $bussinesType->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.bussinesTypes.show', [$bussinesType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.bussinesTypes.edit', [$bussinesType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>