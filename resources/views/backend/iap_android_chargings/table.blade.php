<table class="table table-responsive table-striped table-bordered table-hover" id="iapAndroidChargings-table">
    <thead>
        <th>Profile Id</th>
        <th>{!! trans("iapAndroid.type") !!}</th>
        <th>{!! trans("iapAndroid.amount") !!}</th>
        <th>{!! trans("iapAndroid.point") !!}</th>
        <th>Product Id</th>
        <th>Package</th>
        <th>Response</th>
        <th>{!! trans("app.created_at") !!}</th>
        <th>{!! trans("app.detail") !!}</th>
    </thead>
    <tbody>
    @foreach($iapAndroidChargings as $iapAndroidCharging)
        <tr>
            <td>{!! $iapAndroidCharging->profile_id !!}</td>
            <td>{!! $iapAndroidCharging->type !!}</td>
            <td>{!! $iapAndroidCharging->amount !!}</td>
            <td>{!! $iapAndroidCharging->point !!}</td>
            <td>{!! $iapAndroidCharging->product_id !!}</td>
            <td>{!! $iapAndroidCharging->package !!}</td>
            <td>{!! $iapAndroidCharging->response !!}</td>
            <td>{!! $iapAndroidCharging->created_at !!}</td>
            <td>
                <div class='btn-group'>
                    <a href="{!! route('backend.iapAndroidChargings.show', [$iapAndroidCharging->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>