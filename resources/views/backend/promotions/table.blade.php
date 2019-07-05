<div class="table-responsive">
    <table class="table table-responsive table-striped table-bordered table-hover" id="promotions-table">
        <thead>
        <th>ID</th>
        <th>Ảnh</th>
        <th>Tiêu Đề</th>
        <th>Nội Dung</th>
        <th>Mã</th>
        <th>Giá Trị</th>
        <th>Ngày Tạo</th>
        <th>Ngày Cập Nhật</th>
        <th colspan="3">Action</th>
        </thead>
        <tbody>
        @foreach($promotions as $promotion)
        <tr>
            <td>{!! $promotion->id !!}</td>
            <td>{!! Html::image(\App\Models\BaseModel::getImage( $promotion->img_path) , '',['style' => 'width:80px;
                height:80px']); !!}
            </td>
            <td>{!! $promotion->title !!}</td>
            <td>{!! $promotion->content !!}</td>
            <td>{!! $promotion->code !!}</td>
            <td>{!! $promotion->value !!}</td>
            <td>{!! $promotion->created_at !!}</td>
            <td>{!! $promotion->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.promotions.destroy', $promotion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.promotions.show', [$promotion->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.promotions.edit', [$promotion->id]) !!}" class='btn btn-default btn-xs'><i
                                class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn
                    btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>