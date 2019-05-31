@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit Notification <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-home"></i>Update #<?=$notification->id?></h3>
           </div>
           <div class="box-body">
               {!! Form::model($notification, ['route' => ['backend.notifications.update', $notification->id], 'method' => 'patch']) !!}

                    @include('backend.notifications.fields')

               {!! Form::close() !!}
           </div>
       </div>
    </div>
@endsection