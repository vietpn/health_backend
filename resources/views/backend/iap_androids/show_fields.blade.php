<!-- Id Field -->

{{--<tr>--}}
    {{--<td>Id:</td>--}}
    {{--<td>{!! $iapAndroid->id !!}</td>--}}
{{--</tr>--}}


<!-- Product Id Field -->

<tr>
    <td>Product Id:</td>
    <td>{!! $iapAndroid->product_id !!}</td>
</tr>


<!-- Avatar Field -->

<tr>
    <td>{!! trans("iapAndroid.avatar") !!}:</td>
    <td><?php
        if ( isset($iapAndroid) && !empty($iapAndroid->avatar)) {
            echo Html::image(\App\Models\BaseModel::getImage( $iapAndroid->avatar) , '',['style' => 'width:80px; height:80px']);
            echo "<br/>";
        } else {
            echo '<img class="thumbnail" src="http://placehold.it/100x100" alt="" width="100" height="100" />';
        }
        ?>
    </td>
</tr>


<!-- Display Name Field -->

<tr>
    <td>{!! trans("iapAndroid.name") !!}:</td>
    <td>{!! $iapAndroid->display_name !!}</td>
</tr>


<!-- Package Field -->

<tr>
    <td>Package:</td>
    <td>{!! $iapAndroid->package !!}</td>
</tr>


<!-- Description Field -->

<tr>
    <td>{!! trans("iapAndroid.description") !!}:</td>
    <td>{!! $iapAndroid->description !!}</td>
</tr>


<!-- Price Field -->

<tr>
    <td>{!! trans("iapAndroid.price") !!}:</td>
    <td>{!! $iapAndroid->price !!}</td>
</tr>


<!-- Point Field -->

<tr>
    <td>{!! trans("iapAndroid.point") !!}:</td>
    <td>{!! $iapAndroid->point !!}</td>
</tr>


<!-- Status Field -->

<tr>
    <td>{!! trans("app.status") !!}:</td>
    <td>{!! \App\Models\BaseModel::getStatusName($iapAndroid->status) !!}</td>
</tr>


<!-- Created At Field -->

<tr>
    <td>{!! trans("app.created_at") !!}:</td>
    <td>{!! $iapAndroid->created_at !!}</td>
</tr>


{{--<!-- Updated At Field -->--}}

{{--<tr>--}}
    {{--<td>Updated At:</td>--}}
    {{--<td>{!! $iapAndroid->updated_at !!}</td>--}}
{{--</tr>--}}


{{--<!-- Created Id Field -->--}}

{{--<tr>--}}
    {{--<td>Created Id:</td>--}}
    {{--<td>{!! $iapAndroid->created_id !!}</td>--}}
{{--</tr>--}}


{{--<!-- Updated Id Field -->--}}

{{--<tr>--}}
    {{--<td>Updated Id:</td>--}}
    {{--<td>{!! $iapAndroid->updated_id !!}</td>--}}
{{--</tr>--}}


