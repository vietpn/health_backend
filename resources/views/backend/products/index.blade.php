@extends('layouts.app')

@section('header')
	<section class="content-header">
		<h1>
			Quản lý Products <span class="text-lowercase">{{ '' }}</span>
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

                @include('backend.products.search')

                <div class="clearfix"></div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-home"></i>Sản phẩm</h3>
                    </div>
                    <div class="box-body">
                        <p>
                            <a class="btn btn-primary"  href="{!! route('backend.products.create') !!}">Tạo mới</a>
                        </p>
                            @include('backend.products.table')
                            <div style="padding-left: 20px;padding-right: 20px;">
                                @include('adminlte-templates::common.paginate', ['records' => $products])
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

