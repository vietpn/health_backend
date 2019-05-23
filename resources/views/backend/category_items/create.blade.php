@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! trans('app.create').trans('menus.categoryItems') !!} <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">

                {!! Form::open(['route' => 'backend.categoryItems.store', 'files' => true]) !!}

                    @include('backend.category_items.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
