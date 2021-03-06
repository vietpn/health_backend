@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Create Notification <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">

                {!! Form::open(['route' => 'backend.notifications.store']) !!}

                    @include('backend.notifications.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
