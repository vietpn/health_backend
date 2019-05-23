@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit Iap Ios <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-home"></i>{!! trans('app.update') !!} #<?=$iapIos->id?></h3>
           </div>
           <div class="box-body">
               {!! Form::model($iapIos, ['route' => ['backend.iapIos.update', $iapIos->id], 'method' => 'patch', 'files' => true]) !!}

                    @include('backend.iap_ios.fields')

               {!! Form::close() !!}
           </div>
       </div>
    </div>
@endsection