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
                                <div class="search">
                                    @include('backend.profiles.show_point.search')
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-responsive table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">User Id</th>
                                                <th class="text-center">UserName</th>
                                                <th class="text-center">Point</th>
                                                <th class="text-center">Type</th>
                                                <th class="text-center">Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($datapoint)>0)
                                                @php  $i=1;@endphp
                                                @foreach($datapoint as $item)
                                                <tr>
                                                    <td class="text-center">{!! $i++ !!}</td>
                                                    <td class="text-center">{!! isset($item->getProfile->username)?$item->getProfile->username:"" !!}</td>
                                                    <td class="text-center">{!! isset($item->getProfile->name)?$item->getProfile->name:"" !!}</td>
                                                    <td class="text-center">{!! $item->point !!}</td>
                                                    <td class="text-center">{!! $item->type_name !!}</td>
                                                    <td class="text-center">{!! $item->created_at !!}</td>
                                                </tr>
                                                @endforeach
                                            @else

                                            @endif
                                        </tbody>
                                    </table>
                                    <div style="margin-top: 20px;text-align: center;">
                                        {!!  $datapoint->appends(Request::except('page'))->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection