@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Create Profile Plus History <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">

                {!! Form::open(['route' => 'backend.profilePlusHistories.store']) !!}

                    @include('backend.profile_plus_histories.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
