<!-- Id Field -->

<tr>
    <td>Id:</td>
    <td>{!! $pin->id !!}</td>
</tr>


<!-- Name Field -->

<tr>
    <td>{!! trans('pin.name') !!}:</td>
    <td>{!! $pin->name !!}</td>
</tr>


<!-- Avatar Field -->

<tr>
    <td>{!! trans('pin.avatar') !!}:</td>
    <td><?php
        if ( isset($pin) && !empty($pin->avatar)) {
            echo Html::image( $pin->avatar, '',[]);
            echo "<br/>";
        }
        ?>
    </td>
</tr>


<!-- Point Field -->

<tr>
    <td>{!! trans('pin.point') !!}:</td>
    <td>{!! $pin->point !!}</td>
</tr>


<!-- Status Field -->

<tr>
    <td>{!! trans('app.status') !!}:</td>
    <td>{!! $pin->status !!}</td>
</tr>


<!-- Created At Field -->

<tr>
    <td>{!! trans('app.created_at') !!}:</td>
    <td>{!! $pin->created_at !!}</td>
</tr>


<!-- Created Id Field -->

{{--<tr>--}}
    {{--<td>Created Id:</td>--}}
    {{--<td>{!! $pin->created_id !!}</td>--}}
{{--</tr>--}}


