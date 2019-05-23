@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit Iap Android <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-home"></i>{!! trans('app.update') !!} #<?=$iapAndroid->id?></h3>
           </div>
           <div class="box-body">
               {!! Form::model($iapAndroid, ['route' => ['backend.iapAndroids.update', $iapAndroid->id], 'method' => 'patch', 'files' => true]) !!}

                    @include('backend.iap_androids.fields')

               {!! Form::close() !!}
           </div>
       </div>
    </div>
@endsection