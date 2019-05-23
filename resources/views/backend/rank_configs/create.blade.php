@extends('layouts.app')
@section('title',' Create Rank Config')
@section('content')
    <section class="content-header">
        <h1>
            Create Rank Config <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
    <div class="content">
        <div class="container-fluid spark-screen">

            <div class="row">
                <div class="content">
                    <div class="clearfix"></div>

                @include('adminlte-templates::common.errors')
                @include('flash::message')
                <!--Chọn cửa hàng hoặc member-->

                    <div class="clearfix"></div>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><i class="fa fa-home"></i>{!! __('profiles.home') !!}</h3>
                        </div>
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="choose-profile">
                                    <ul class="nav nav-tabs" id="maincontent" role="tablist">
                                        <li>
                                            <a href="{!! route('backend.profiles.index') !!}">{!! __('profiles.search_member') !!}</a>
                                        </li>
                                        <li class="active">
                                            <a href="{!! route('backend.rankConfigs.index') !!}">{!! __('profiles.member_rank') !!}</a>
                                        </li>
                                    </ul><!--/.nav-tabs.content-tabs -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="search_store">
                                            <h2 class="text-center">Set khoản tiền</h2>
                                            {!! Form::open(['route' => 'backend.rankConfigs.store']) !!}

                                            @include('backend.rank_configs.fields')

                                            {!! Form::close() !!}
                                        </div><!--/.tab-pane -->
                                    </div><!--/.tab-content -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="box box-primary">--}}

            {{--<div class="box-body">--}}

                {{--{!! Form::open(['route' => 'backend.rankConfigs.store']) !!}--}}

                    {{--@include('backend.rank_configs.fields')--}}

                {{--{!! Form::close() !!}--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
@endsection
