<table class="table table-responsive table-striped table-bordered table-hover" id="posts-table">
    <thead>
    <th>{!! trans('app.avatar') !!}</th>
    <th>{!! trans('app.user_name') !!}</th>
    <th>{!! trans('app.content') !!}</th>
    <th>{!! trans('app.like') !!}</th>
    <th>{!! trans('app.report') !!}</th>
    {{--<th>Is Deleted</th>--}}
    <th>{!! trans('app.created_at') !!}</th>
    <th>{!! trans('app.updated_at') !!}</th>
    <th colspan="2">{!! trans('app.action') !!}</th>
    </thead>
    <tbody>
    @foreach($comments as $comment)
        <tr>
            <td>
                <?php
                if (!empty($comment->photo)) {
                    echo Html::image(\App\Models\BaseModel::getImage($comment->photo), '', ['style' => 'width:80px; height:80px']);
                    echo "<br/>";
                } else {
                    echo '<img class="thumbnail" src="http://placehold.it/100x100" alt="" width="100" height="100" />';
                }
                ?>
            </td>
            <td>{!! $comment->name !!}</td>
            <td>{!! $comment->content !!}</td>
            <td>{!! $comment->likes !!}</td>

            <?php if(!empty($comment->reports)):?>
            <td style="color: red">Report</td>
            <?php else:?>
            <td></td>
            <?php endif;?>

            <td>{!! $comment->created_at !!}</td>
            <td>{!! $comment->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.comments.destroy', $comment->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>