@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            ポイント設定変更画面 <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-home"></i>{!! trans('app.update') !!} #<?=$pointConfig->id?></h3>
           </div>
           <div class="box-body">
               {!! Form::model($pointConfig, ['route' => ['backend.pointConfigs.update', $pointConfig->id], 'method' => 'patch']) !!}

                    @include('backend.point_configs.fields')

               {!! Form::close() !!}
           </div>
       </div>
    </div>
@endsection