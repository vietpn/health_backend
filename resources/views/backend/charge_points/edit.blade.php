@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit Charge Point <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-home"></i>Update #<?=$chargePoint->id?></h3>
           </div>
           <div class="box-body">
               {!! Form::model($chargePoint, ['route' => ['backend.chargePoints.update', $chargePoint->id], 'method' => 'patch']) !!}

                    @include('backend.charge_points.fields')

               {!! Form::close() !!}
           </div>
       </div>
    </div>
@endsection