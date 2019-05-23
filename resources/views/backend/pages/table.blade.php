<table class="table table-responsive table-striped table-bordered table-hover" id="pages-table">
    <thead>
        <th>{!! trans('app.title') !!}</th>
        <th>{!! trans('app.alias') !!}</th>
        <th>{!! trans('app.created_at') !!}</th>
        <th>{!! trans('app.updated_at') !!}</th>
        <th colspan="3">{!! trans('app.action') !!}</th>
    </thead>
    <tbody>
    @foreach($pages as $page)
        <tr>
            <td>{!! $page->title !!}</td>
            <td>{!! $page->alias !!}</td>
            <td>{!! $page->created_at !!}</td>
            <td>{!! $page->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.pages.destroy', $page->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.pages.show', [$page->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.pages.edit', [$page->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>