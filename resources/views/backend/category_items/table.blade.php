<table class="table table-responsive table-striped table-bordered table-hover" id="categoryItems-table">
    <thead>
        <th>ID</th>
        <th>{!! trans('app.avatar') !!}}</th>
        <th>{!! trans('app.title') !!}</th>
        <th>{!! trans('app.sort_order') !!}</th>
        <th>{!! trans('app.type') !!}</th>
        <th>{!! trans('app.code') !!}</th>
        <th>{!! trans('app.status') !!}</th>
        <th>{!! trans('app.created_at') !!}</th>
        <th colspan="3">{!! trans('app.action') !!}</th>
    </thead>
    <tbody>
    @foreach($categoryItems as $categoryItem)
        <tr>
            <td>{!! $categoryItem->id !!}</td>
            <td><?php echo Html::image(\App\Models\BaseModel::getImage( $categoryItem->avatar) , '',['style' => 'width:80px; height:80px']) ?></td>
            <td>{!! $categoryItem->title !!}</td>
            <td>{!! $categoryItem->sort_order !!}</td>
            <td>{!! \App\Models\BaseModel::getCategoryTypeName($categoryItem->type) !!}</td>
            <td>{!! $categoryItem->code !!}</td>
            <td>{!! \App\Models\BaseModel::getStatusName($categoryItem->status) !!}</td>
            <td>{!! $categoryItem->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.categoryItems.destroy', $categoryItem->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.categoryItems.show', [$categoryItem->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.categoryItems.edit', [$categoryItem->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>