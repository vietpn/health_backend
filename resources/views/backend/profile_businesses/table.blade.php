<table class="table table-responsive table-striped table-bordered table-hover" id="profileBusinesses-table">
    <thead>
        <th>
            {{--Business Name--}}
            {!! trans('profileBusiness.business_name') !!}
        </th>
        <th>
            {{--Created At--}}
            {!! trans('profileBusiness.created_at') !!}
        </th>
        <th>
            {{--Location--}}
            {!! trans('profileBusiness.location') !!}
        </th>
        <th>
            {{--Detail--}}
            {!! trans('profileBusiness.detail') !!}
        </th>
        <th>
            {{--Delete--}}
            {!! trans('profileBusiness.delete') !!}
        </th>
    </thead>
    <tbody>
    @foreach($profileBusinesses as $profileBusiness)
        <tr>
            <td>{!! $profileBusiness->name !!}</td>
            <td>{!! $profileBusiness->post_created_at !!}</td>
            <td>{!! $profileBusiness->location_string !!}</td>

            <td>
                <a href="{!! route('backend.profileBusinesses.show', [$profileBusiness->post_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
            </td>

            <td>
                {!! Form::open(['route' => ['backend.profileBusinesses.destroy', $profileBusiness->post_id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('". trans('profileBusiness.confirm_delete') . "')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>