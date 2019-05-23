<table class="table table-responsive table-striped table-bordered table-hover" id="posts-table">
    <thead>
    <th>{!! trans('app.avatar') !!}</th>
    <th>{!! trans('app.user_name') !!}</th>
    <th>{!! trans('app.age') !!}</th>
    <th>{!! trans('app.gender') !!}</th>
    <th>{!! trans('app.content') !!}</th>
    <th>{!! trans('app.pin_id') !!}</th>
    <th>{!! trans('app.longitude') !!}</th>
    <th>{!! trans('app.latitude') !!}</th>

    <th>{!! trans('app.like') !!}</th>
    <th>{!! trans('app.comment') !!}</th>
    <th>{!! trans('app.view') !!}</th>
    <th>{!! trans('app.report') !!}</th>
    <th>{!! trans('app.create') !!}</th>
    <th colspan="3">{!! trans('app.action') !!}</th>
    </thead>
    <tbody>
    @foreach($posts as $post)
        <tr>
            <td>
                <?php
                if (!empty($post->photo)) {
                    echo Html::image(\App\Models\BaseModel::getImage($post->photo), '', ['style' => 'width:80px; height:80px']);
                    echo "<br/>";
                } else {
                    echo '<img class="thumbnail" src="http://placehold.it/100x100" alt="" width="100" height="100" />';
                }
                ?>
            </td>
            <td>{!! $post->name !!}</td>
            <td>{!! $post->birth_year !!}</td>
            <td>{!! $post->gender !!}</td>
            <td>{!! $post->content !!}</td>
            <td>{!! $post->pin_id !!}</td>
            <td>{!! $post->longitude !!}</td>
            <td>{!! $post->latitude !!}</td>

            <td>{!! $post->likes !!}</td>
            <td>{!! $post->comments !!}</td>
            <td>{!! $post->views !!}</td>
            <td style="color: red">
                <?php if (!empty($post->reports)): ?>
                Report
                <?php endif;?>
            </td>

            <td>{!! $post->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.posts.destroy', $post->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.posts.show', [$post->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>