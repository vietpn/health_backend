<div class="col-md-7">
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>{!! trans('app.user_name') !!}</th>
            <td>{!! $profile->name !!}</td>
            <th>{!! __('profiles.profiles_default.hobbies') !!}</th>
            <td>{!! $profileUser->hobbies !!}</td>
        </tr>
        <tr>
            <th>{!! trans('app.user_id') !!}</th>
            <td>{!! $profile->username !!}</td>
            <th>{!! __('profiles.profiles_default.fear') !!}</th>
            <td>{!! $profileUser->my_current_obsession !!}</td>
        </tr>
        <tr>
            <th>{!! trans('app.black_user') !!}</th>
            <td></td>
            <th>{!! __('profiles.profiles_default.pride_thing') !!}</th>
            <td>{!! $profileUser->achievement !!}</td>
        </tr>
        <tr>
            <th>{!! __('profiles.profiles_default.gender') !!}</th>
            <td>
                @if($profileUser->gender == 1 || $profileUser->gender == -1)
                    Men
                @else
                    Girl
                @endif
            </td>
            <th>{!! __('profiles.profiles_default.favorite_place') !!}</th>
            <td>{!! $profileUser->favorite_place !!}</td>
        </tr>
        <tr>
            <th>{!! __('profiles.location') !!}</th>
            <td>{!! $profile->location !!}</td>
            <th>{!! __('profiles.profiles_default.favorite_place') !!}</th>
            <td>{!! $profileUser->favorite_place !!}</td>
        </tr>
        <tr>
            <th>{!! __('profiles.profiles_default.age') !!}</th>
            <td>{!! $profileUser->birth_year !!}</td>
            <th>{!! __('profiles.profiles_default.favorite_celebrity') !!}</th>
            <td>{!! $profileUser->favorite_celebrity !!}</td>
        </tr>
        <tr>
            <th>{!! trans('app.rank') !!}</th>
            <td></td>
            <th>{!! __('profiles.profiles_default.favorite_music') !!}</th>
            <td>{!! $profileUser->favorite_music !!}</td>
        </tr>
        <tr>
            <th>{!! __('profiles.created_at') !!}</th>
            <td>{!! $profile->created_at !!}</td>
            <th>{!! __('profiles.profiles_default.favorite_sport') !!}</th>
            <td>{!! $profileUser->favorite_sport !!}</td>
        </tr>
        <tr>
            <th>{!! __('profiles.last_login') !!}</th>
            <td>{!! $profile->last_login !!}</td>
            <th>{!! __('profiles.profiles_default.favorite_word') !!}</th>
            <td>{!! $profileUser->favorite_word !!}</td>
        </tr>
        <tr>
            <th>{!! __('profiles.profiles_default.blood_type') !!}</th>
            <td>
                @if($profileUser->getBloodType()->first())
                    {!! $profileUser->getBloodType->name !!}
                @endif
            </td>
            <th>{!! __('profiles.profiles_default.hairstyle') !!}</th>
            <td>{!! $profileUser->hairstyle !!}</td>
        </tr>
        <tr>
            <th>{!! __('profiles.profiles_default.birthday') !!}</th>
            <td>{!! date('m-d-Y',strtotime($profileUser->birthday)) !!}</td>
            <th>{!! __('profiles.profiles_default.height') !!}</th>
            <td>{!! $profileUser->height !!}</td>
        </tr>
        <tr>
            <th>{!! __('profiles.profiles_default.zodiac_sign') !!}</th>
            <td>
                @if($profileUser->getZodiacSign()->first())
                    {!! $profileUser->getZodiacSign->name !!}
                @endif
            </td>
            <th>{!! __('profiles.profiles_default.weight') !!}</th>
            <td>{!! $profileUser->weight !!}</td>
        </tr>
        <tr>
            <th>{!! __('profiles.profiles_default.introduce_yourself') !!}</th>
            <td>{!! $profileUser->description !!}</td>
            <th>{!! __('profiles.profiles_default.language') !!}</th>
            <td>{!! $profileUser->language !!}</td>
        </tr>
        <tr>
            <th>{!! __('profiles.profiles_default.hometown') !!}</th>
            <td>{!! $profileUser->hometown !!}</td>
            <th></th>
            <td></td>
        </tr>
        <tr>
            <th>{!! __('profiles.profiles_default.same_person') !!}</th>
            <td>{!! $profileUser->same_person !!}</td>
            <th></th>
            <td></td>
        </tr>
        <tr>
            <th>{!! __('profiles.profiles_default.personnality') !!}</th>
            <td>{!! $profileUser->personnality !!}</td>
            <th></th>
            <td></td>
        </tr>
    </table>
</div>