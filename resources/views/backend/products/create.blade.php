@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Create Product <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">

                {!! Form::open(['route' => 'backend.products.store', 'files' => true]) !!}

                    @include('backend.products.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
