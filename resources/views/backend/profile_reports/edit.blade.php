@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit Profile Report <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
            <div class="box-header with-border">
               <h3 class="box-title"><i class="fa fa-home"></i>Update #<?=$profileReport->id?></h3>
           </div>
           <div class="box-body">
               {!! Form::model($profileReport, ['route' => ['backend.profileReports.update', $profileReport->id], 'method' => 'patch']) !!}

                    @include('backend.profile_reports.fields')

               {!! Form::close() !!}
           </div>
       </div>
    </div>
@endsection