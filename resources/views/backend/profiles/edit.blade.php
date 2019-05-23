@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit Profile <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-home"></i>Update #<?=$profile->id?></h3>
           </div>
           <div class="box-body">
               {!! Form::model($profile, ['route' => ['backend.profiles.update', $profile->id], 'method' => 'patch']) !!}

                    @include('backend.profiles.fields')

               {!! Form::close() !!}
           </div>
       </div>
    </div>
@endsection