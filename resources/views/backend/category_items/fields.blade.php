<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', trans('app.title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Avatar Field -->
<div class="form-group">
    {!! Form::label('avatar', trans('app.avatar').':') !!}
    {!! Form::file('avatar', ['class' => 'form-control']) !!}
    <?php
    if ( isset($categoryItem) && !empty($categoryItem->avatar)) {
        echo Html::image(\App\Models\BaseModel::getImage( $categoryItem->avatar) , '',['style' => 'width:80px; height:80px']);
        echo "<br/>";
    } else {
        echo '<img class="thumbnail" src="http://placehold.it/100x100" alt="" width="100" height="100" />';
    }
    ?>
</div>

<!-- Sort order Field -->
<div class="form-group">
    {!! Form::label('sort_order', trans('app.sort_order').':') !!}
    {!! Form::number('sort_order', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('type', trans('app.type').':', ['class' => 'control-label']) !!}
    {!! Form::select('type', \App\Models\BaseModel::getCategoryTypeList(), null, ['class' => 'form-control', 'style'=>'width:300px']) !!}
</div>

<!-- Sort order Field -->
<div class="form-group">
    {!! Form::label('code', trans('app.code').':') !!}
    {!! Form::number('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', trans('app.status').':', ['class' => 'control-label']) !!}
    {!! Form::select('status', \App\Models\BaseModel::getStatusList(), isset($categoryItem) ? intval($categoryItem->status) : null, ['class' => 'form-control', 'style'=>'width:300px']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('app.save'), ['class' => 'btn btn-primary']) !!}
</div>
