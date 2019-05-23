<!-- Username Field -->
<div class="form-group">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Location Field -->
<div class="form-group">
    {!! Form::label('location', 'Location:') !!}
    {!! Form::text('location', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Field -->
<div class="form-group">
    {!! Form::label('country', 'Country:') !!}
    {!! Form::text('country', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Remember Token Field -->
<div class="form-group">
    {!! Form::label('remember_token', 'Remember Token:') !!}
    {!! Form::text('remember_token', null, ['class' => 'form-control']) !!}
</div>

<!-- Point Field -->
<div class="form-group">
    {!! Form::label('point', 'Point:') !!}
    {!! Form::number('point', null, ['class' => 'form-control']) !!}
</div>

<!-- Avatar Path Field -->
<div class="form-group">
    {!! Form::label('avatar_path', 'Avatar Path:') !!}
    {!! Form::text('avatar_path', null, ['class' => 'form-control']) !!}
</div>

<!-- Cover Path Field -->
<div class="form-group">
    {!! Form::label('cover_path', 'Cover Path:') !!}
    {!! Form::text('cover_path', null, ['class' => 'form-control']) !!}
</div>

<!-- Longitude Field -->
<div class="form-group">
    {!! Form::label('longitude', 'Longitude:') !!}
    {!! Form::number('longitude', null, ['class' => 'form-control']) !!}
</div>

<!-- Latitude Field -->
<div class="form-group">
    {!! Form::label('latitude', 'Latitude:') !!}
    {!! Form::number('latitude', null, ['class' => 'form-control']) !!}
</div>

<!-- Online Status Field -->
<div class="form-group">
    {!! Form::label('online_status', 'Online Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('online_status', false) !!}
        {!! Form::checkbox('online_status', '1', null) !!} 1
    </label>
</div>

<!-- Is Business Field -->
<div class="form-group">
    {!! Form::label('is_business', 'Is Business:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('is_business', false) !!}
        {!! Form::checkbox('is_business', '1', null) !!} 1
    </label>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    {!! Form::date('created_at', null, ['class' => 'form-control']) !!}
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    {!! Form::date('updated_at', null, ['class' => 'form-control']) !!}
</div>

<!-- Last Updated Field -->
<div class="form-group">
    {!! Form::label('last_updated', 'Last Updated:') !!}
    {!! Form::date('last_updated', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.profiles.index') !!}" class="btn btn-default">Cancel</a>
</div>
