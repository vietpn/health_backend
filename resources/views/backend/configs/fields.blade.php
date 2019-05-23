<!-- Key Field -->
<div class="form-group">
    {!! Form::label('key', trans('app.key')) !!}
    {!! Form::text('key', null, ['class' => 'form-control']) !!}
</div>

<!-- Value Field -->
<div class="form-group">
    {!! Form::label('value', trans('app.value')) !!}
    {!! Form::text('value', null, ['class' => 'form-control']) !!}
</div>

<!-- Describe Field -->
<div class="form-group">
    {!! Form::label('describe', trans('app.description')) !!}
    {!! Form::text('describe', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', trans('app.status'), ['class' => 'control-label']) !!}
    {!! Form::select('status', \App\Models\BaseModel::getStatusList(), null, ['class' => 'form-control', 'style'=>'width:300px']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('app.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.configs.index') !!}" class="btn btn-default">{!! trans('app.cancel') !!}</a>
</div>
