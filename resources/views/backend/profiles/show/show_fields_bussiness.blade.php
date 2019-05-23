<div class="col-md-7">
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>{!! trans('app.user_name') !!}</th>
            <td>{!! $profile->name !!}</td>
        </tr>
        <tr>
            <th>{!! trans('app.user_id') !!}</th>
            <td>{!! $profile->username !!}</td>
        </tr>
        <tr>
            <th>{!! trans('app.black_user') !!}</th>
            <td></td>
        </tr>
        <tr>
            <th>{!! __('profiles.location') !!}</th>
            <td>{!! $profile->location !!}</td>
        </tr>
        <tr>
            <th>{!! __('profiles.profiles_bussiness.bussiness_type') !!}</th>
            <td>
                @if(isset($profileUser->getBussinessType))
                    {!! $profileUser->getBussinessType->title !!}
                @endif
            </td>

        </tr>
        <tr>
            <th>{!! trans('app.rank') !!}</th>
            <td></td>
        </tr>
        <tr>
            <th>{!! __('profiles.created_at') !!}</th>
            <td>{!! $profile->created_at !!}</td>
        </tr>
        <tr>
            <th>{!! __('profiles.last_login') !!}</th>
            <td>{!! $profile->last_login !!}</td>
        </tr>
        <tr>
            <th>{!! trans('app.phone_number') !!}</th>
            <td>
                {!! $profileUser->mobile !!}
            </td>
        </tr>
        <tr>
            <th>{!! trans('app.pin') !!}</th>
            <td></td>
        </tr>
        <tr>
            <th>Expired pin</th>
            <td>
            </td>
        </tr>
    </table>
</div>