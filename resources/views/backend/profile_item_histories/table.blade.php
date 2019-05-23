<table class="table table-responsive table-striped table-bordered table-hover" id="profileItemHistories-table">
    <thead>
        <th>Id</th>
        <th>{!! trans('app.item') !!} Id</th>
        <th>{!! trans('app.user_name') !!}</th>
        <th>{!! trans('app.item_name') !!}</th>
        <th>{!! trans('app.point') !!}</th>
        <th>{!! trans('app.created_at') !!}</th>
        <th colspan="3">{!! trans('app.action') !!}</th>
    </thead>
    <tbody>
    @foreach($profileItemHistories as $profileItemHistory)
        <tr>
            <td>{!! $profileItemHistory->id !!}</td>
            <td>{!! $profileItemHistory->item_id !!}</td>
            <td>{!! $profileItemHistory->profile->name !!}</td>
            <td>{!! $profileItemHistory->item->name  !!}</td>
            <td>{!! $profileItemHistory->point !!}</td>
            <td>{!! $profileItemHistory->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['backend.profileItemHistories.destroy', $profileItemHistory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('backend.profileItemHistories.show', [$profileItemHistory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $profileItemHistories->appends(['end_time'=>$end_time, 'start_time'=>$start_time])->render() !!}