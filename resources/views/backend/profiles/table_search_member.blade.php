<table class="table table-responsive table-striped table-bordered table-hover" id="profiles-table">
    <tbody>
    @php($i=0)
    @foreach($profiles as $profile)

        @php($i++)
        <tr>
            <td class="text-center" rowspan="2">
                @if($profile->avatar_path !="")
                    <img src="{!! $profile->avatar_path !!}" height="90" width="90">
                @else
                    <i class="fa fa-picture-o img-default" aria-hidden="true" ></i>
                @endif
            </td>
            <th class="text-center">{!! __('profiles.name') !!}</th>
            <td class="text-center">{!! $profile->name !!}</td>
            <th class="text-center">{!! __('profiles.date_register') !!}</th>
            <td class="text-center">{!! $profile->created_at !!}</td>
        </tr>
        <tr>
            <td class="text-center" colspan="5">
                <a href="{!! route('backend.profiles.show',$profile->id) !!}" class="btn btn-primary">{!! __('systems.details') !!}</a>
                @if((int)$profile->status === 0)
                    <a href="{!! route('backend.profiles.show_ban_nick',$profile->id) !!}" class="btn btn-success">{!! __('profiles.active_nick') !!}</a>
                @elseif((int)$profile->status === 1)
                    <a href="{!! route('backend.profiles.show_ban_nick',$profile->id) !!}" class="btn btn-danger">{!! __('systems.ban_nick') !!}</a>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<div style="margin-top: 20px;text-align: center;">
    {!!  $profiles->appends(Request::except('page'))->links() !!}
</div>