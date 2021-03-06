<!-- Img Path Field -->
<div class="form-group">
    {!! Form::label('image', 'Ảnh:') !!}
    {!! Form::file('image', ['class' => 'form-control', 'accept' => 'image/*']) !!}
    <?php
    if ( isset($promotion) && !empty($promotion->img_path)) {
        echo Html::image(\App\Models\BaseModel::getImage( $promotion->img_path) , '',['style' => 'width:80px; height:80px']);
        echo "<br/>";
    } else {
        echo '<img class="thumbnail" src="http://placehold.it/100x100" alt="" width="100" height="100" />';
    }
    ?>
</div>

<!-- Code Field -->
<div class="form-group">
  {!! Form::label('title', 'Tiêu Đề:') !!}
  {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Nội Dung:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Code Field -->
<div class="form-group">
    {!! Form::label('code', 'Mã:') !!}
    {!! Form::text('code', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Value Field -->
<div class="form-group">
    {!! Form::label('value', 'Giá Trị:') !!}
    {!! Form::number('value', null, ['class' => 'form-control', 'required', 'min' => '0', 'max' => '100']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.promotions.index') !!}" class="btn btn-default">Cancel</a>
</div>
