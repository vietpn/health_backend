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
            {!! trans('menus.post') !!}
        </h1>
    </section>

    <div class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-home"></i>Post Id #<?=$post->id?></h3>
            </div>
            <div class="box-body">
                <div class="row" style="padding-left: 20px; padding-right: 20px">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover"
                                   style="padding-left: 20px; padding-right: 20px">
                                <!-- Content Field -->
                                <tr>
                                    <td>{!! trans('app.content') !!}:</td>
                                    <td>{!! $post->content !!}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="content-header">
        <h1>
            {!! trans('list_comment') !!}
        </h1>
    </section>

    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px; padding-right: 20px">
                    <table class="table table-striped table-bordered table-hover">
                        @include('backend.posts.show_fields_comment')
                        <div style="padding-left: 20px;padding-right: 20px;">
                            @include('adminlte-templates::common.paginate', ['records' => $comments])
                        </div>
                    </table>

                    <div class="row" style="text-align: center">
                        <a href="{!! route('backend.posts.show', $post->id) !!}" class="btn btn-default"
                           style="margin-left: 10px;">{!! trans('app.back') !!}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
