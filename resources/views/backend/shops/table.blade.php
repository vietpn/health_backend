<table class="table table-responsive table-striped table-bordered table-hover" id="shops-table">
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Avatar</th>
        <th>Hyperlink</th>
        <th>Bussines Type</th>
        <th>Profile</th>
        <th>Mobile</th>
        <th>Created At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($shops as $shop)
        <tr>
            <td>{!! $shop->id !!}</td>
            <td>{!! $shop->name !!}</td>
            <td><?php echo Html::image(\App\Models\BaseModel::getImage( $shop->avatar) , '',['style' => 'width:80px; height:80px']) ?></td>
            <td>{!! $shop->hyperlink !!}</td>
            <td>{!! \App\Models\BussinesType::getBussinesTypeName($shop->bussines_type_id) !!}</td>
            <td>{!! $shop->profile_id !!}</td>
            <td>{!! $shop->mobile !!}</td>
            <td>{!! $shop->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.shops.destroy', $shop->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.shops.show', [$shop->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.shops.edit', [$shop->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>