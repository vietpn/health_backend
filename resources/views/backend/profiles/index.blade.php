@extends('layouts.app')

@section('header')
    <section class="content-header">
        <h1>
            Manage Profiles <span class="text-lowercase">{{ '' }}</span>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ '' }}" class="text-capitalize">{{ '' }}</a></li>
            <li class="active">{{ '' }}</li>
        </ol>

    </section>
@endsection

@section('content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="content">
                <div class="clearfix"></div>

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
                                    <li class="active">
                                        <a href="{!! route('backend.profiles.index') !!}">{!! __('profiles.search_member') !!}</a>
                                    </li>
                                    <li>
                                        <a href="{!! route('backend.rankConfigs.index') !!}">{!! __('profiles.member_rank') !!}</a>
                                    </li>
                                </ul><!--/.nav-tabs.content-tabs -->
                                <div class="tab-content">

                                    <div class="tab-pane fade in active" id="search_member">
                                        @include('backend.profiles.search_member')
                                        <div class="table-responsive" id="table-view">
                                            @include('backend.profiles.table_search_member')
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
        </div>
    </div>
@endsection
@section('scripts')
    {!! Html::script('assets/plugins/datepicker/bootstrap-datepicker.js') !!}
    {!! Html::script('assets/plugins/iCheck/icheck.min.js') !!}
    <script>
        !function ($) {
            $(function () {
                //Date picker
                $('#datepicker').datepicker({
                    autoclose: true
                })
                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass: 'iradio_minimal-blue'
                })
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                })
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                })
            });
        }(window.jQuery);
    </script>
@endsection


