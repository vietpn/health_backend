<table class="table table-responsive table-striped table-bordered table-hover" id="orders-table">
    <thead>
        <th>Profile Id</th>
        <th>Total Price</th>
        <th>Promo Code</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{!! $order->profile_id !!}</td>
            <td>{!! \App\Define\Systems::formatPrice($order->total_price) !!}</td>
            <td>{!! $order->promo_code !!}</td>
            <td>{!! $order->status !!}</td>
            <td>{!! $order->created_at !!}</td>
            <td>{!! $order->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.orders.destroy', $order->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.orders.show', [$order->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('backend.orders.edit', [$order->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>