@extends('layouts.app')

@section('header')
    <section class="content-header">
        <h1>
            Quản lý Bussines<span class="text-lowercase">{{ '' }}</span>
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

                </div>
            </div>
        </div>
    </div>
@endsection

