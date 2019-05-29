@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit Promotion <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-home"></i>Update #<?=$promotion->id?></h3>
           </div>
           <div class="box-body">
               {!! Form::model($promotion, ['route' => ['backend.promotions.update', $promotion->id], 'method' => 'patch', 'files' => true]) !!}

                    @include('backend.promotions.fields')

               {!! Form::close() !!}
           </div>
       </div>
    </div>
@endsection