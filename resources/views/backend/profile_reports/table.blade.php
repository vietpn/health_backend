<table class="table table-responsive table-striped table-bordered table-hover" id="profileReports-table">
    <thead>
        <th>Profile Id</th>
        <th>Profile Name</th>
        <th>Profile Id Report</th>
        <th>Profile Report Name</th>
        <th>Status</th>
        <th>Des</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($profileReports as $profileReport)
        <tr>
            <td>{!! $profileReport->profile_id !!}</td>
            <td>{!! $profileReport->profile_name !!}</td>
            <td>{!! $profileReport->profile_id_report !!}</td>
            <td>{!! $profileReport->profile_report_name !!}</td>
            <td>{!! \App\Models\BaseModel::getStatusName($profileReport->status) !!}</td>
            <td>{!! $profileReport->des !!}</td>
            <td>{!! $profileReport->created_at !!}</td>
            <td>{!! $profileReport->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.profileReports.destroy', $profileReport->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.profileReports.show', [$profileReport->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.profileReports.edit', [$profileReport->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>