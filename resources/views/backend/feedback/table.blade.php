<div class="table-responsive">
    <table class="table table-responsive table-striped table-bordered table-hover" id="feedback-table">
        <thead>
        <th>ID</th>
        <th>Username</th>
        <th>Nội dung</th>
        <th>Trạng thái</th>
        <th>Ngày tạo</th>
        <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($feedback as $feedback)
        <tr>
            <td>{!! $feedback->id !!}</td>
            <td>{!! $feedback->username !!}</td>
            <td>{!! $feedback->content !!}</td>
            <td>{!! \App\Models\BaseModel::getStatusFeedBack($feedback->status) !!}</td>
            <td>{!! $feedback->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.feedback.destroy', $feedback->id], 'method' => 'delete']) !!}
                <div>
                    <a href="{!! route('backend.feedback.show', [$feedback->id]) !!}" class='btn btn-default '><i
                                class="glyphicon glyphicon-eye-open"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn
                    btn-danger ', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>