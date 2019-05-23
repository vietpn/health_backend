@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit Bussines Type <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-home"></i>{{ trans('app.update') }} #<?=$bussinesType->id?></h3>
           </div>
           <div class="box-body">
               {!! Form::model($bussinesType, ['route' => ['backend.bussinesTypes.update', $bussinesType->id], 'method' => 'patch']) !!}

                    @include('backend.bussines_types.fields')

               {!! Form::close() !!}
           </div>
       </div>
    </div>
@endsection