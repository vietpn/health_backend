@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! trans('app.update') !!}} {!! trans('menus.categoryItems') !!} <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-home"></i>{!! trans('app.update') !!} #<?=$categoryItem->id?></h3>
           </div>
           <div class="box-body">
               {!! Form::model($categoryItem, ['route' => ['backend.categoryItems.update', $categoryItem->id], 'method' => 'patch', 'files' => true]) !!}

                    @include('backend.category_items.fields')

               {!! Form::close() !!}
           </div>
       </div>
    </div>
@endsection