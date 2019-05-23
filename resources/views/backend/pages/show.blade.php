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
            Page
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-home"></i>{!! trans('app.view') !!} #<?=$page->id?></h3>
            </div>
            <div class="box-body">
                <div class="row" style="padding-left: 20px; padding-right: 20px">
                <table class="table table-striped table-bordered table-hover">
                    @include('backend.pages.show_fields')
                </table>
                    <a href="{!! route('backend.pages.index') !!}" class="btn btn-default">{!! trans('app.back') !!}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
