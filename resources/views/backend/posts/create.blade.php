@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! trans('app.create').trans('menus.post') !!} <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">

                {!! Form::open(['route' => 'backend.posts.store']) !!}

                    @include('backend.posts.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
