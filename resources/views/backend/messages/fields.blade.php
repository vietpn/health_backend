<!-- Messages Field -->
<div class="form-group">
    {!! Form::label('messages', 'Messages:') !!}
    {!! Form::text('messages', null, ['class' => 'form-control']) !!}
</div>

<!-- Profile Id Field -->
<div class="form-group">
    {!! Form::label('profile_id', 'Profile Id:') !!}
    {!! Form::number('profile_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Profile Sent Field -->
<div class="form-group">
    {!! Form::label('profile_sent', 'Profile Sent:') !!}
    {!! Form::number('profile_sent', null, ['class' => 'form-control']) !!}
</div>

<!-- Profile Recive Field -->
<div class="form-group">
    {!! Form::label('profile_recive', 'Profile Recive:') !!}
    {!! Form::number('profile_recive', null, ['class' => 'form-control']) !!}
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

<!-- Time Sent Field -->
<div class="form-group">
    {!! Form::label('time_sent', 'Time Sent:') !!}
    {!! Form::text('time_sent', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Image Field -->
<div class="form-group">
    {!! Form::label('is_image', 'Is Image:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('is_image', false) !!}
        {!! Form::checkbox('is_image', '1', null) !!} 1
    </label>
</div>

<!-- Is Read Field -->
<div class="form-group">
    {!! Form::label('is_read', 'Is Read:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('is_read', false) !!}
        {!! Form::checkbox('is_read', '1', null) !!} 1
    </label>
</div>

<!-- Is Read All Field -->
<div class="form-group">
    {!! Form::label('is_read_all', 'Is Read All:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('is_read_all', false) !!}
        {!! Form::checkbox('is_read_all', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.messages.index') !!}" class="btn btn-default">Cancel</a>
</div>
