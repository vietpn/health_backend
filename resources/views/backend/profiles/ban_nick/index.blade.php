@extends('layouts.app')

@section('header')
<section class="content-header">
    <h1>
        @yield('breadcrumb_title') <span class="text-lowercase">{{ '' }}</span>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ '' }}" class="text-capitalize">{{ '' }}</a></li>
        <li class="active">{{ '' }}</li>
    </ol>

</section>
@endsection

@section('content')
<section class="content-header">
    <h1>
        Profile
    </h1>
</section>
<div class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-home"></i>{!! __('profiles.home') !!}</h3>
        </div>
        <div class="box-body">
            <div class="col-md-12">
                <div class="choose-profile">
                    <ul class="nav nav-tabs" id="maincontent" role="tablist">
                        <li class="active"><a href="#search_member" role="tab"
                                              data-toggle="tab">{!! __('profiles.search_member') !!}</a>
                        </li>
                        <li><a href="#search_store" role="tab"
                               data-toggle="tab">{!! __('profiles.member_rank') !!}</a></li>
                    </ul><!--/.nav-tabs.content-tabs -->
                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="search_member">
                            <div class="row" style="padding-left: 20px; padding-right: 20px">
                                <div class="col-md-3">
                                    <div class="box box-primary">
                                        <div class="box-body box-profile">
                                            <img class="profile-user-img img-responsive img-circle"
                                                 src="{!! $profile->avatar_path !!}" alt="User profile picture">

                                            <h3 class="profile-username text-center">{!! $profile->name !!}</h3>

                                            <p class="text-muted text-center">Point :
                                                <b>{!! \App\Define\Systems::formatPrice($profile->point) !!}</b></p>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                                <div class="col-md-9 ">
                                    <div class="nav-tabs-custom">
                                        <table width="50%" class="list-ban-nick">
                                            <tbody>
                                            <tr>
                                                <th style="width: 25%">{!! __('profiles.name') !!} :   </th>
                                                <td>
                                                    <span class="username">
                                                      <a href="{!! route('backend.profiles.show',$profile->id) !!}">{!! $profile->name !!}</a>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="width: 25%">{!! __('profiles.username') !!} :   </th>
                                                <td>
                                                    {!! $profile->username !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="width: 25%">{!! __('profiles.created_at') !!} :   </th>
                                                <td>
                                                    {!! $profile->created_at !!}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            @if($profile->status === 0)
                                                <button class="btn btn-success active-profile" data-profile="{!! $profile->id !!}">{!! __('profiles.active_nick') !!}</button>
                                            @elseif($profile->status === 1)
                                                <button class="btn btn-danger btn-ban-nick" data-profile="{!! $profile->id !!}">{!! __('profiles.ban_nick') !!}</button>
                                            @endif
                                            <a href="{!! route('backend.profiles.index') !!}" class="btn btn-info">{!! __('systems.back') !!}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--/.tab-pane -->

                        <div class="tab-pane fade" id="search_store">
                            @include('backend.profiles.search_store')
                        </div><!--/.tab-pane -->
                    </div><!--/.tab-content -->
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('scripts')
<script>
    !function ($) {
        $(function () {
            //ban nick
            $('.btn-ban-nick').click(function () {
                var id = $(this).attr('data-profile');
                box1 = new ajaxLoader('body', {classOveride: 'blue-loader', bgColor: '#000', opacity: '0.3'});
                $.ajax({
                    url: "{{ route('backend.profiles.edit') }}",
                    type: 'POST',
                    data: {id: id},
                    datatype: 'json',
                    headers: {'X-CSRF-Token': "{!! csrf_token() !!}"},
                    success: function (response) {
                        if (response.error === false) {
                            $('#modal-success').modal('show');
                            $('.add-msg').html("").append(response.message);
                            window.location.reload(true);
                        }else{
                            $('#modal-danger').modal('show');
                            $('.add-msg-error').html("").append(response.message);
                        }
                    },
                    error: function (obj, status, err) {
                        alert("{{ trans('systems.have_an_error') }}");
                    }
                }).always(function () {
                    if (box1) box1.remove();
                });
            });
            //active nick
            $('.active-profile').click(function () {
                var id = $(this).attr('data-profile');
                box1 = new ajaxLoader('body', {classOveride: 'blue-loader', bgColor: '#000', opacity: '0.3'});
                $.ajax({
                    url: "{{ route('backend.profiles.active_nick') }}",
                    type: 'POST',
                    data: {id: id},
                    datatype: 'json',
                    headers: {'X-CSRF-Token': "{!! csrf_token() !!}"},
                    success: function (response) {
                        if (response.error === false) {
                            $('#modal-success').modal('show');
                            $('.add-msg').html("").append(response.message);
                            window.location.reload(true);

                        }else{
                            $('#modal-danger').modal('show');
                            $('.add-msg-error').html("").append(response.message);
                        }
                    },
                    error: function (obj, status, err) {
                        alert("{{ trans('systems.have_an_error') }}");
                    }
                }).always(function () {
                    if (box1) box1.remove();
                });
            })
        });
    }(window.jQuery);

</script>
@endsection