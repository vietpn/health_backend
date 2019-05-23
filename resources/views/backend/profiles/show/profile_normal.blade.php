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
            {!! trans('app.user') !!}
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-home"></i>{!! trans('app.view') !!} #<?=$profile->id?></h3>
            </div>
            <div class="box-body">
                <div class="row" style="padding-left: 20px; padding-right: 20px">
                    <div class="col-md-3">
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle"
                                     src="{!! $profile->avatar_path !!}" alt="User profile picture">

                                <h3 class="profile-username text-center">{!! $profile->name !!}</h3>

                                <p class="text-muted text-center">{!! trans('app.point') !!} :
                                    <b>{!! \App\Define\Systems::formatPrice($profile->point) !!}</b></p>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    @if($profile->is_business == PROFILE_DEFAULT)
                        @include('backend.profiles.show.show_fields')
                    @elseif($profile->is_business == PROFILE_BUSSINESS)

                        @include('backend.profiles.show.show_fields_bussiness')
                    @endif
                    <div class="col-md-2">
                        <div class="row">
                            <div class="col-md-12 text-left margin-default">
                                <a href="{!! route('backend.profiles.show_point',['id'=>$profile->id]) !!}" class="btn btn-primary"><i class="fa fa-history" aria-hidden="true"></i> {!! __('systems.history_point') !!}</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-left margin-default">
                                <button type="button" class="btn btn-danger btn-ban-nick" data-profile="{!! $profile->id !!}"><i class="fa fa-cog"></i> {!! __('systems.ban_nick') !!}</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-left margin-default">
                                <a href="{!! route('backend.profiles.index') !!}" class="btn btn-primary"><i class="fa fa-long-arrow-left" aria-hidden="true"></i>  {!! __('systems.back') !!}</a>
                            </div>
                        </div>
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