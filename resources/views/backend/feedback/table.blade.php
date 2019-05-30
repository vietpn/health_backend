<table class="table table-responsive table-striped table-bordered table-hover" id="feedback-table">
    <thead>
        <th>Username</th>
        <th>Content</th>
        <th>Img Path</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($feedback as $feedback)
        <tr>
            <td>{!! $feedback->username !!}</td>
            <td>{!! $feedback->content !!}</td>
            <td>{!! $feedback->img_path !!}</td>
            <td>{!! $feedback->created_at !!}</td>
            <td>{!! $feedback->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.feedback.destroy', $feedback->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.feedback.show', [$feedback->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>