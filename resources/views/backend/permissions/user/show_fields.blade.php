<tr>
    <td>Id:</td>
    <td>{!! $model->id !!}</td>
</tr>

<tr>
    <td>{{ trans('users.user.email') }}:</td>
    <td>{!! $model->email !!}</td>
</tr>

<tr>
    <td>{{ trans('users.user.first_name') }}:</td>
    <td>{!! $model->first_name !!}</td>
</tr>

<tr>
    <td>{{ trans('users.user.last_name') }}:</td>
    <td>{!! $model->last_name !!}</td>
</tr>


<tr>
    <td>{{ trans('users.user.created_at') }}:</td>
    <td>{!! $model->created_at !!}</td>
</tr>

<tr>
    <td>{{ trans('users.user.last_login') }}:</td>
    <td>{!! $model->last_login !!}</td>
</tr>
