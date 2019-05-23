@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! trans('app.update'). trans('menus.configs') !!} <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-home"></i>{!! trans('app.update') !!} #<?=$config->id?></h3>
           </div>
           <div class="box-body">
               {!! Form::model($config, ['route' => ['backend.configs.update', $config->id], 'method' => 'patch']) !!}

                    @include('backend.configs.fields')

               {!! Form::close() !!}
           </div>
       </div>
    </div>
@endsection