<!-- Profile Id Field -->
<div class="form-group">
    {!! Form::label('profile_id', 'Profile Id:') !!}
    {!! Form::number('profile_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Price Field -->
<div class="form-group">
    {!! Form::label('total_price', 'Total Price:') !!}
    {!! Form::number('total_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Promo Code Field -->
<div class="form-group">
    {!! Form::label('promo_code', 'Promo Code:') !!}
    {!! Form::text('promo_code', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', false) !!}
        {!! Form::checkbox('status', '1', null) !!} 1
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.orders.index') !!}" class="btn btn-default">Cancel</a>
</div>
