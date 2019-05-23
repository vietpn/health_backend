<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', trans('app.title') .':' ) !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Alias Field -->
<div class="form-group">
    {!! Form::label('alias', trans('app.alias') .':') !!}
    {!! Form::text('alias', null, ['class' => 'form-control']) !!}
</div>

<!-- Content En Field -->
<div class="form-group">
    {!! Form::label('content_en', trans('app.content').':') !!}
    {!! Form::textarea('content_en', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('app.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.pages.index') !!}" class="btn btn-default">{!! trans('app.cancel') !!}</a>
</div>

@section('child-scripts')
    <script src="/ckeditor/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace( 'content_en' );
    </script>
@stop