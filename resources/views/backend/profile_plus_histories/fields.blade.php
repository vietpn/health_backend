<!-- Profile Id Field -->
<div class="form-group">
    {!! Form::label('profile_id', 'Profile Id:') !!}
    {!! Form::number('profile_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Point Field -->
<div class="form-group">
    {!! Form::label('point', 'Point:') !!}
    {!! Form::number('point', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', 'Type:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('type', false) !!}
        {!! Form::checkbox('type', '1', null) !!} 1
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

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.profilePlusHistories.index') !!}" class="btn btn-default">Cancel</a>
</div>
