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
                <h3 class="box-title"><i class="fa fa-home"></i>{!! trans('app.update') !!} #<?=$post->id?></h3>
            </div>
            <div class="box-body">
                <div class="row" style="padding-left: 20px; padding-right: 20px">

                @include('backend.posts.show_fields')

                <div class="row" style="text-align: center">
                    {!! Form::open(['route' => ['backend.posts.destroy', $post->id], 'method' => 'delete', 'style' => 'display: inline']) !!}
                        {!! Form::button(trans('app.delete'), ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    {!! Form::close() !!}

                    <a href="{!! route('backend.posts.index') !!}" class="btn btn-default" style="margin-left: 10px;">{!! trans('app.back') !!}</a>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
