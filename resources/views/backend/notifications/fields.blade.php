<!-- Content Field -->
<div class="form-group">
    {!! Form::label('content', 'Nội dung:') !!}
    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.notifications.index') !!}" class="btn btn-default">Cancel</a>
</div>
