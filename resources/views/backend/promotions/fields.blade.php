<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Nội Dung:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Img Path Field -->
<div class="form-group">
  {!! Form::label('img_path', 'Ảnh:') !!}
  {!! Form::file('img_path', ['class' => 'form-control']) !!}
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
    {!! Form::label('code', 'Mã:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Value Field -->
<div class="form-group">
    {!! Form::label('value', 'Giá Trị:') !!}
    {!! Form::number('value', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.promotions.index') !!}" class="btn btn-default">Cancel</a>
</div>
