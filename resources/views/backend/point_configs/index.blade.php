@extends('layouts.app')

@section('header')
	<section class="content-header">
		<h1>
			Quản lý Point Configs <span class="text-lowercase">{{ '' }}</span>
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

                <div class="clearfix"></div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-home"></i>ポイント設定一覧</h3>
                    </div>
                    <div class="box-body">
                        <p>
                            <a class="btn btn-primary"  href="{!! route('backend.pointConfigs.create') !!}">{!! trans('app.create') !!}</a>
                        </p>
                            @include('backend.point_configs.table')
                            <div style="padding-left: 20px;padding-right: 20px;">
                                @include('adminlte-templates::common.paginate', ['records' => $pointConfigs])
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

