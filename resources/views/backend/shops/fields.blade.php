<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Avatar Field -->
<div class="form-group">
    {!! Form::label('avatar', 'Avatar:') !!}
    {!! Form::file('avatar', ['class' => 'form-control']) !!}
    <?php
    if ( isset($shop) && !empty($shop->avatar)) {
        echo Html::image(\App\Models\BaseModel::getImage( $shop->avatar) , '',['style' => 'width:80px; height:80px']);
        echo "<br/>";
    } else {
        echo '<img class="thumbnail" src="http://placehold.it/100x100" alt="" width="100" height="100" />';
    }
    ?>
</div>

<!-- Hyperlink Field -->
<div class="form-group">
    {!! Form::label('hyperlink', 'Hyperlink:') !!}
    {!! Form::text('hyperlink', null, ['class' => 'form-control']) !!}
</div>

<!-- Bussines Type Id Field -->
<div class="form-group">
    {!! Form::label('bussines_type_id', 'Bussines Type:') !!}
    {!! Form::select('bussines_type_id', \App\Models\BussinesType::getListBussinesType(), null, ['class' => 'form-control', 'style'=>'width:300px']) !!}
</div>

<!-- Mobile Field -->
<div class="form-group">
    {!! Form::label('mobile', 'Mobile:') !!}
    {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.shops.index') !!}" class="btn btn-default">Cancel</a>
</div>
