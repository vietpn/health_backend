<!-- Id Field -->

{{--<tr>--}}
    {{--<td>Id:</td>--}}
    {{--<td>{!! $iapIos->id !!}</td>--}}
{{--</tr>--}}


<!-- Apple Id Field -->

<tr>
    <td>Apple Id:</td>
    <td>{!! $iapIos->apple_id !!}</td>
</tr>


<!-- Product Id Field -->

<tr>
    <td>Product Id:</td>
    <td>{!! $iapIos->product_id !!}</td>
</tr>


<!-- Avatar Field -->

<tr>
    <td>{!! trans("app.avatar") !!}:</td>
    <td>{!! $iapIos->avatar !!}</td>
</tr>


<!-- Display Name Field -->

<tr>
    <td>{!! trans("iapIos.display_name") !!}:</td>
    <td>{!! $iapIos->display_name !!}</td>
</tr>


<!-- Description Field -->

<tr>
    <td>{!! trans("iapIos.description") !!}:</td>
    <td>{!! $iapIos->description !!}</td>
</tr>


<!-- Price Field -->

<tr>
    <td>{!! trans("iapIos.price") !!}:</td>
    <td>{!! $iapIos->price !!}</td>
</tr>


<!-- Point Field -->

<tr>
    <td>{!! trans("iapIos.point") !!}}:</td>
    <td>{!! $iapIos->point !!}</td>
</tr>


<!-- Status Field -->

<tr>
    <td>{!! trans("app.status") !!}:</td>
    <td>{!! \App\Models\BaseModel::getStatusName($iapIos->status) !!}</td>
</tr>


<!-- Created At Field -->

<tr>
    <td>{!! trans("app.created_at") !!}:</td>
    <td>{!! $iapIos->created_at !!}</td>
</tr>

