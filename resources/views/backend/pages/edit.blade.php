@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! trans('app.update') . '' . trans('app.pages') !!} <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-home"></i>{!! trans('app.update') !!} #<?=$page->id?></h3>
           </div>
           <div class="box-body">
               {!! Form::model($page, ['route' => ['backend.pages.update', $page->id], 'method' => 'patch']) !!}

                    @include('backend.pages.fields')

               {!! Form::close() !!}
           </div>
       </div>
    </div>
@endsection