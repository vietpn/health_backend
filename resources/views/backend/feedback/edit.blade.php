@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit Feedback <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-home"></i>Update #<?=$feedback->id?></h3>
           </div>
           <div class="box-body">
               {!! Form::model($feedback, ['route' => ['backend.feedback.update', $feedback->id], 'method' => 'patch']) !!}

                    @include('backend.feedback.fields')

               {!! Form::close() !!}
           </div>
       </div>
    </div>
@endsection