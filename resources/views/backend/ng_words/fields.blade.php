<!-- Word Field -->
<div class="form-group">
    {!! Form::label('word', trans('ngWord.ng_word') . ':') !!}
    {!! Form::text('word', null, ['class' => 'form-control']) !!}
</div>

<!-- Pronounce Field -->
<div class="form-group">
    {!! Form::label('pronounce', trans('ngWord.pronounce') .':') !!}
    {!! Form::text('pronounce', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', trans('ngWord.description') .':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('type', trans('app.type'), ['class' => 'control-label']) !!}
    {!! Form::select('type', \App\Models\BaseModel::getNgWordTypeList(), isset($ngWord) ? intval($ngWord->type) : null, ['class' => 'form-control', 'style'=>'width:300px']) !!}
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', trans('app.status'), ['class' => 'control-label']) !!}
    {!! Form::select('status', \App\Models\BaseModel::getStatusList(), isset($ngWord) ? intval($ngWord->status) : null, ['class' => 'form-control', 'style'=>'width:300px']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit( trans('app.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.ngWords.index') !!}" class="btn btn-default">{!! trans('ngWord.cancel') !!}</a>
</div>
