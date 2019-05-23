<table class="table table-responsive table-striped table-bordered table-hover" id="iapIos-table">
    <thead>
    <th>{!! trans("iapIos.avatar") !!}</th>
    <th>Apple Id</th>
    <th>Product Id</th>
    <th>{!! trans("iapIos.display_name") !!}</th>
    <th>{!! trans("iapIos.description") !!}</th>
    <th>{!! trans("iapIos.price") !!}($)</th>
    <th>{!! trans("iapIos.point") !!}</th>
    <th>{!! trans("app.status") !!}</th>
    <th>{!! trans("app.created_at") !!}</th>
    <th>{!! trans("app.detail") !!}</th>
    <th>{!! trans("app.edit") !!}</th>
    <th>{!! trans("app.delete") !!}</th>
    </thead>
    <tbody>
    @foreach($iapIos as $iapIos)
        <tr>
            <td><?php echo Html::image(\App\Models\BaseModel::getImage($iapIos->avatar), '', ['style' => 'width:80px; height:80px']) ?></td>
            <td>{!! $iapIos->apple_id !!}</td>
            <td>{!! $iapIos->product_id !!}</td>
            <td>{!! $iapIos->display_name !!}</td>
            <td>{!! $iapIos->description !!}</td>
            <td>{!! $iapIos->price !!}</td>
            <td>{!! $iapIos->point !!}</td>
            <td>{!! \App\Models\BaseModel::getStatusName($iapIos->status) !!}</td>
            <td>{!! $iapIos->created_at !!}</td>
            <td>
                <a href="{!! route('backend.iapIos.show', [$iapIos->id]) !!}" class='btn btn-default btn-xs'><i
                            class="glyphicon glyphicon-eye-open"></i></a>
            </td>
            <td>
                <a href="{!! route('backend.iapIos.edit', [$iapIos->id]) !!}" class='btn btn-default btn-xs'><i
                            class="glyphicon glyphicon-edit"></i></a>
            </td>
            <td>
                {!! Form::open(['route' => ['backend.iapIos.destroy', $iapIos->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".trans("app.confirm_delete")."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>