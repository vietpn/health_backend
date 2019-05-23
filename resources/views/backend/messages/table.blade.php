<table class="table table-responsive table-striped table-bordered table-hover" id="messages-table">
    <thead>
    <th>{!! trans("message.sender") !!}</th>
    <th>{!! trans("message.message") !!}</th>
    <th>{!! trans("message.receiver") !!}</th>
    <th>{!! trans("app.created_at") !!}</th>
    <th>{!! trans("app.detail") !!}</th>
    <th>{!! trans("app.delete") !!}</th>
    </thead>
    <tbody>
    @foreach($messages as $message)
        <tr>
            <td>{!! $message->profileSend->email !!}</td>
            <td>{!! $message->messages !!}</td>
            <td>{!! $message->profileReceive->email !!}</td>
            <td>{!! $message->created_at !!}</td>
            <td>
                <a href="{!! route('backend.messages.show', [$message->id]) !!}" class='btn btn-default btn-xs'><i
                            class="glyphicon glyphicon-comment"></i></a>
            </td>
            <td>
                {!! Form::open(['route' => ['backend.messages.destroy', $message->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".trans("ngWord.confirm_delete")."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $messages->appends(['messages' => $messages, 'sender' => $sender, 'receiver' => $receiver, 'start_time' => $start_time, 'end_time' => $end_time])->render() !!}