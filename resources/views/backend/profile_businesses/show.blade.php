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
            {!! trans('menus.business') !!}
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-home"></i>{!! trans('profileBusiness.detail') !!} #<?=$profileBusiness->id?></h3>
            </div>
            <div class="box-body">
                <div class="row" style="padding-left: 20px; padding-right: 20px">
                    <table class="table table-striped table-bordered table-hover">
                        @include('backend.profile_businesses.show_fields')
                    </table>

                    <div class="row" style="text-align: center">
                        {!! Form::open(['route' => ['backend.profileBusinesses.destroy', $profileBusiness->post_id], 'method' => 'delete', 'style' => 'display: inline']) !!}
                            {!! Form::button(trans('profileBusiness.delete'), ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('" . trans('profileBusiness.confirm_delete') . "')"]) !!}
                        {!! Form::close() !!}

                        <a href="{!! route('backend.profileBusinesses.index') !!}" class="btn btn-default">{!! trans('profileBusiness.back') !!}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
