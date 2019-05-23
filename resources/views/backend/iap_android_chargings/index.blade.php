@extends('layouts.app')

@section('header')
	<section class="content-header">
		<h1>
			Quản lý Iap Android Chargings <span class="text-lowercase">{{ '' }}</span>
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
                        <h3 class="box-title"><i class="fa fa-home"></i>Iap Android Chargings</h3>
                    </div>
                    <div class="box-body">
                        <p>

                        </p>
                            @include('backend.iap_android_chargings.table')
                            <div style="padding-left: 20px;padding-right: 20px;">
                                @include('adminlte-templates::common.paginate', ['records' => $iapAndroidChargings])
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

