<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Nội Dung:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Img Path Field -->
<div class="form-group">
    {!! Form::label('image', 'Ảnh:') !!}
    {!! Form::file('image', null, ['class' => 'form-control', 'accept' => 'image/*']) !!}
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
