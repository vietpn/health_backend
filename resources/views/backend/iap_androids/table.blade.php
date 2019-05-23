<table class="table table-responsive table-striped table-bordered table-hover" id="iapAndroids-table">
    <thead>
    <th>{!! trans("iapAndroid.avatar") !!}</th>
    <th>Product Id</th>
    <th>{!! trans("iapAndroid.name") !!}</th>
    <th>Package</th>
    <th>{!! trans("iapAndroid.price") !!}($)</th>
    <th>{!! trans("iapAndroid.point") !!}</th>
    <th>{!! trans("app.status") !!}</th>
    <th>{!! trans("app.created_at") !!} At</th>
    <th>{!! trans("app.detail") !!}</th>
    <th>{!! trans("app.edit") !!}</th>
    <th>{!! trans("app.delete") !!}</th>
    </thead>
    <tbody>
    @foreach($iapAndroids as $iapAndroid)
        <tr>
            <td><?php echo Html::image(\App\Models\BaseModel::getImage($iapAndroid->avatar), '', ['style' => 'width:80px; height:80px']) ?></td>
            <td>{!! $iapAndroid->product_id !!}</td>
            <td>{!! $iapAndroid->display_name !!}</td>
            <td>{!! $iapAndroid->package !!}</td>
            <td>{!! $iapAndroid->price !!}</td>
            <td>{!! $iapAndroid->point !!}</td>
            <td>{!! \App\Models\BaseModel::getStatusName($iapAndroid->status) !!}</td>
            <td>{!! $iapAndroid->created_at !!}</td>
            <td>
                <a href="{!! route('backend.iapAndroids.show', [$iapAndroid->id]) !!}" class='btn btn-default btn-xs'><i
                            class="glyphicon glyphicon-eye-open"></i></a>
            </td>
            <td>
                <a href="{!! route('backend.iapAndroids.edit', [$iapAndroid->id]) !!}" class='btn btn-default btn-xs'><i
                            class="glyphicon glyphicon-edit"></i></a>
            </td>
            <td>
                {!! Form::open(['route' => ['backend.iapAndroids.destroy', $iapAndroid->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".trans("app.confirm_delete")."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>