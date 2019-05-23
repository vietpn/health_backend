<!-- Profile Id Field -->
<div class="form-group">
    {!! Form::label('profile_id', 'Profile Id:') !!}
    {!! Form::number('profile_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Profile Id Report Field -->
<div class="form-group">
    {!! Form::label('profile_id_report', 'Profile Id Report:') !!}
    {!! Form::number('profile_id_report', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', false) !!}
        {!! Form::checkbox('status', '1', null) !!} 1
    </label>
</div>

<!-- Des Field -->
<div class="form-group">
    {!! Form::label('des', 'Des:') !!}
    {!! Form::text('des', null, ['class' => 'form-control']) !!}
</div>

<!-- Created At Field -->
{{--<div class="form-group">--}}
    {{--{!! Form::label('created_at', 'Created At:') !!}--}}
    {{--{!! Form::date('created_at', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Updated At Field -->
{{--<div class="form-group">--}}
    {{--{!! Form::label('updated_at', 'Updated At:') !!}--}}
    {{--{!! Form::date('updated_at', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.profileReports.index') !!}" class="btn btn-default">Cancel</a>
</div>
