<table class="table table-responsive table-striped table-bordered table-hover" id="promotions-table">
    <thead>
        <th>Content</th>
        <th>Img Path</th>
        <th>Code</th>
        <th>Value</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($promotions as $promotion)
        <tr>
            <td>{!! $promotion->content !!}</td>
            <td>{!! $promotion->img_path !!}</td>
            <td>{!! $promotion->code !!}</td>
            <td>{!! $promotion->value !!}</td>
            <td>{!! $promotion->created_at !!}</td>
            <td>{!! $promotion->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.promotions.destroy', $promotion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.promotions.show', [$promotion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.promotions.edit', [$promotion->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>