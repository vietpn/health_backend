@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! trans("ngWord.edit") !!} NG Word<span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-home"></i>{!! trans('app.update') !!} #<?=$ngWord->id?></h3>
           </div>
           <div class="box-body">
               {!! Form::model($ngWord, ['route' => ['backend.ngWords.update', $ngWord->id], 'method' => 'patch']) !!}

                    @include('backend.ng_words.fields')

               {!! Form::close() !!}
           </div>
       </div>
    </div>
@endsection