<!-- Id Field -->

<tr>
    <td>Id:</td>
    <td>{!! $pointConfig->id !!}</td>
</tr>


<!-- Key Field -->

<tr>
    <td>{!! trans('app.key') !!}:</td>
    <td>{!! $pointConfig->key !!}</td>
</tr>


<!-- Point Field -->

<tr>
    <td>{!! trans('app.point') !!}:</td>
    <td>{!! $pointConfig->point !!}</td>
</tr>


<!-- Describe Field -->

<tr>
    <td>{!! trans('app.description') !!}:</td>
    <td>{!! $pointConfig->describe !!}</td>
</tr>


<!-- Status Field -->

<tr>
    <td>{!! trans('app.status') !!}:</td>
    <td>{!! App\Models\BaseModel::getStatusName($pointConfig->status) !!}</td>
</tr>


