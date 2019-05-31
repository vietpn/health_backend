<!-- Profile Id Field -->
<div class="form-group">
    {!! Form::label('username', 'Username:') !!}
    <div>{!! $order->username !!}</div>
</div>

<!-- Total Price Field -->
<div class="form-group">
    {!! Form::label('total_price', 'Giá:') !!}
    <div>{!! \App\Define\Systems::formatPrice($order->total_price) !!}</div>
</div>

<!-- Promo Code Field -->
<div class="form-group">
    {!! Form::label('promo_code', 'Mã KM:') !!}
    <div>{!! $order->promo_code !!}</div>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Trạng thái:') !!}
    {!! Form::select('status', \App\Models\BaseModel::getStatusList(), isset($order) ? intval($order->status) : null, ['class' => 'form-control', 'style'=>'width:300px']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.orders.index') !!}" class="btn btn-default">Cancel</a>
</div>
