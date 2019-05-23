<!-- Avatar Field -->
<div class="form-group">
    {!! Form::label('avatar', trans("app.avatar") . ':') !!}
    {!! Form::file('avatar', null, ['class' => 'form-control']) !!}
</div>

<!-- Apple Id Field -->
<div class="form-group">
    {!! Form::label('apple_id', 'Apple Id:') !!}
    {!! Form::text('apple_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Id Field -->
<div class="form-group">
    {!! Form::label('product_id', 'Product Id:') !!}
    {!! Form::text('product_id', null, ['class' => 'form-control']) !!}
</div>


<!-- Display Name Field -->
<div class="form-group">
    {!! Form::label('display_name', trans("iapIos.display_name") . ':') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', trans("iapIos.description") . ':') !!}
    {!! Form::textarea('description', null, array('class'=>'form-control', 'size' => '5x2')) !!}
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', trans("iapIos.price") . '($):') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Point Field -->
<div class="form-group">
    {!! Form::label('point', trans("iapIos.point") . ':') !!}
    {!! Form::number('point', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', trans("app.status"), ['class' => 'control-label']) !!}
    {!! Form::select('status', \App\Models\BaseModel::getStatusList(), isset($iapIos) ? intval($iapIos->status) : null, ['class' => 'form-control', 'style'=>'width:300px']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('app.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.iapIos.index') !!}" class="btn btn-default">{!! trans('ngWord.cancel') !!}</a>
</div>

@section('child-scripts')
    <script src="/ckeditor/ckeditor/ckeditor.js"></script>

    <script type="text/javascript">
        CKEDITOR.replace('description',
            {
                toolbarGroups: [
                    {name: 'document', groups: ['mode', 'document']},
                    {name: 'clipboard', groups: ['clipboard', 'undo']},
                    {name: 'links'},
                    {name: 'insert'},
                    {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
                    {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
                ]
            });
    </script>
@stop
