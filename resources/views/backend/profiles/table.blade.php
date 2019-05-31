<table class="table table-responsive table-striped table-bordered table-hover" id="profiles-table">
    <thead>
        <th>Username</th>
        <th>Tện</th>
        <th>Email</th>
        <th>Số ĐT</th>
        <th>Ngày sinh</th>
        <th>Ngày tạo</th>
        <th>Ngày cập nhật</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($profiles as $profile)
        <tr>
            <td>{!! $profile->username !!}</td>
            <td>{!! $profile->name !!}</td>
            <td>{!! $profile->email !!}</td>
            <td>{!! $profile->phone_number !!}</td>
            <td>{!! $profile->birthday !!}</td>
            <td>{!! $profile->created_at !!}</td>
            <td>{!! $profile->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.profiles.destroy', $profile->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.profiles.show', [$profile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.profiles.edit', [$profile->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>