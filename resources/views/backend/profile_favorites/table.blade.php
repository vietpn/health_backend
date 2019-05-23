<table class="table table-responsive table-striped table-bordered table-hover" id="profileFavorites-table">
    <thead>
        <th>Profile Id</th>
        <th>Profile Name</th>
        <th>Profile Id Favorite</th>
        <th>Profile Favorite Name</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($profileFavorites as $profileFavorite)
        <tr>
            <td>{!! $profileFavorite->profile_id !!}</td>
            <td>{!! $profileFavorite->profile_name !!}</td>
            <td>{!! $profileFavorite->profile_id_favorite !!}</td>
            <td>{!! $profileFavorite->profile_favorite_name !!}</td>
            <td>{!! $profileFavorite->created_at !!}</td>
            <td>{!! $profileFavorite->updated_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.profileFavorites.destroy', $profileFavorite->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.profileFavorites.show', [$profileFavorite->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>