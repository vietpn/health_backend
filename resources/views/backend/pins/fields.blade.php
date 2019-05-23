<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', trans("pin.name") . ':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('avatar', trans("pin.avatar") . ':') !!}
    {!! Form::file('avatar', ['class' => 'form-control']) !!}
    <?php
    if (isset($pin) && !empty($pin->avatar)) {
        echo Html::image($pin->avatar, '', ['style' => 'width:19px; height:19px']);
        echo "<br/>";
    } else {
        echo '<img class="thumbnail" src="http://placehold.it/19x19" alt="" width="19" height="19" />';
    }
    ?>
</div>

<!-- Point Field -->
<div class="form-group">
    {!! Form::label('point', trans("pin.point") . ':') !!}
    {!! Form::number('point', null, ['class' => 'form-control', 'style' => 'width:300px;']) !!}
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status',  trans("app.status"), ['class' => 'control-label']) !!}
    {!! Form::select('status', \App\Models\BaseModel::getStatusList(), isset($pin) ? intval($pin->status) : null, ['class' => 'form-control', 'style'=>'width:300px']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit( trans("app.save"), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.pins.index') !!}" class="btn btn-default">{!! trans("app.cancel") !!}</a>
</div>
