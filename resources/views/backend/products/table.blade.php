<table class="table table-responsive table-striped table-bordered table-hover" id="products-table">
    <thead>
        <th>ID</th>
        <th>Tên</th>
        <th>Ảnh</th>
        <th>Giá</th>
        <!--<th>Giá mới</th>-->
        <th>Số lượng</th>
        <th>Ngày tạo</th>
        <th>Ngày cập nhật</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{!! $product->id !!}</td>
            <td>{!! $product->name !!}</td>
            <td>{!! Html::image(\App\Models\BaseModel::getImage( $product->img_path) , '',['style' => 'width:80px; height:80px']); !!}</td>
            <td>{!! \App\Define\Systems::formatPrice($product->price) !!}</td>
            <!--<td>{!! \App\Define\Systems::formatPrice($product->new_price) !!}</td>-->
            <td>{!! $product->amount !!}</td>
            <td>{!! $product->created_at !!}</td>
            <td>{!! $product->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.products.destroy', $product->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.products.show', [$product->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.products.edit', [$product->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>