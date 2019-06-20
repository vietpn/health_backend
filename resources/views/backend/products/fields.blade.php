<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Tên:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Img Path Field -->
<div class="form-group">
    {!! Form::label('image', 'Ảnh:') !!}
    {!! Form::file('image', ['class' => 'form-control', 'accept' => 'image/*']) !!}
    <?php
    if ( isset($product) && !empty($product->img_path)) {
        echo Html::image(\App\Models\BaseModel::getImage( $product->img_path) , '',['style' => 'width:80px; height:80px']);
        echo "<br/>";
    } else {
        echo '<img class="thumbnail" src="http://placehold.it/100x100" alt="" width="100" height="100" />';
    }
    ?>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Giá:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- New Price Field -->
<!--<div class="form-group">
    {!! Form::label('new_price', 'Giá mới:') !!}
    {!! Form::number('new_price', null, ['class' => 'form-control']) !!}
</div>-->


<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Số lượng:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>


<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Hàm lượng:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Chemicals Field -->
<div class="form-group">
    {!! Form::label('chemicals', 'Hoá chất:') !!}
    {!! Form::textarea('chemicals', null, ['class' => 'form-control']) !!}
</div>

<!-- Packaging Field -->
<div class="form-group">
    {!! Form::label('packaging', 'Đóng gói:') !!}
    {!! Form::textarea('packaging', null, ['class' => 'form-control']) !!}
</div>

<!-- Manufacturer Field -->
<div class="form-group">
    {!! Form::label('manufacturer', 'Hãng sản xuất:') !!}
    {!! Form::textarea('manufacturer', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.products.index') !!}" class="btn btn-default">Cancel</a>
</div>
