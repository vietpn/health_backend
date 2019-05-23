<table class="table table-responsive table-striped table-bordered table-hover" id="iapIosChargings-table">
    <thead>
        <th>Profile Id</th>
        <th>{!! trans("iapIos.amount") !!}</th>
        <th>{!! trans("iapIos.point") !!}</th>
        <th>Product Id</th>
        <th>Apple Id</th>
        <th>Response</th>
        <th>{!! trans("app.created_at") !!}</th>
        <th>{!! trans("app.detail") !!}</th>
    </thead>
    <tbody>
    @foreach($iapIosChargings as $iapIosCharging)
        <tr>
            <td>{!! $iapIosCharging->profile_id !!}</td>
            <td>{!! $iapIosCharging->amount !!}</td>
            <td>{!! $iapIosCharging->point !!}</td>
            <td>{!! $iapIosCharging->product_id !!}</td>
            <td>{!! $iapIosCharging->apple_id !!}</td>
            <td>{!! $iapIosCharging->response !!}</td>
            <td>{!! $iapIosCharging->created_at !!}</td>
            <td>
                <div class='btn-group'>
                    <a href="{!! route('backend.iapIosChargings.show', [$iapIosCharging->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>