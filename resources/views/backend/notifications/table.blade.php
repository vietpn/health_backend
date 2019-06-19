<table class="table table-responsive table-striped table-bordered table-hover" id="notifications-table">
    <thead>
        <th>Tiêu Đề</th>
        <th>Nội Dung</th>
        <th>Ngày tạo</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($notifications as $notification)
        <tr>
            <td>{!! $notification->title !!}</td>
            <td>{!! $notification->content !!}</td>
            <td>{!! $notification->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.notifications.destroy', $notification->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.notifications.show', [$notification->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>