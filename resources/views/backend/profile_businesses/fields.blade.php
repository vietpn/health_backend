<!-- Profile Id Field -->
<div class="form-group">
    {!! Form::label('profile_id', 'Profile Id:') !!}
    {!! Form::number('profile_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Business Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Avatar Field -->
<div class="form-group">
    {!! Form::label('avatar', 'Avatar:') !!}
    {!! Form::text('avatar', null, ['class' => 'form-control']) !!}
</div>

<!-- Hyperlink Field -->
<div class="form-group">
    {!! Form::label('hyperlink', 'Hyperlink:') !!}
    {!! Form::text('hyperlink', null, ['class' => 'form-control']) !!}
</div>

<!-- Rel Hyperlink Field -->
<div class="form-group">
    {!! Form::label('rel_hyperlink', 'Rel Hyperlink:') !!}
    {!! Form::text('rel_hyperlink', null, ['class' => 'form-control']) !!}
</div>

<!-- Bussines Type Id Field -->
<div class="form-group">
    {!! Form::label('bussines_type_id', 'Bussines Type Id:') !!}
    {!! Form::number('bussines_type_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Mobile Field -->
<div class="form-group">
    {!! Form::label('mobile', 'Mobile:') !!}
    {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    {!! Form::date('created_at', null, ['class' => 'form-control']) !!}
</div>

<!-- Updated Id Field -->
<div class="form-group">
    {!! Form::label('updated_id', 'Updated Id:') !!}
    {!! Form::number('updated_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    {!! Form::date('updated_at', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.profileBusinesses.index') !!}" class="btn btn-default">Cancel</a>
</div>
