@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ 'Create Account' }} <span class="text-lowercase">{{ '' }}</span>
        </h1>
    </section>

    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="box-header with-border">
                    <h3 class="box-title">{!! trans('systems.create') !!} {!! trans('users.user.label') !!}</h3>
                </div>
                <div class="box-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    {!! Form::open(['url'=>route('admin.user.store'),'role'=>'form','class'=>'form-horizontal']) !!}
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">{{ trans('users.user.last_name') }} (<span class="required" style="color:red">*</span>) :</label>
                        <div class="col-sm-4">
                            {!! Form::text('last_name',Request::old('last_name'),['class'=>'form-control','id'=>'name','placeholder'=>trans('users.user.last_name')]) !!}
                        </div>
                        <label for="name" class="col-sm-2 control-label">{{ trans('users.user.first_name') }} :</label>
                        <div class="col-sm-4">
                            {!! Form::text('first_name',Request::old('first_name'),['class'=>'form-control','id'=>'first_name','placeholder'=>trans('users.user.first_name')]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">{{ trans('users.user.email') }} (<span class="required" style="color:red">*</span>) :</label>
                        <div class="col-sm-4">
                            {!! Form::text('email',Request::old('email'),['class'=>'form-control','id'=>'email','placeholder'=>trans('users.user.email')]) !!}
                        </div>
                        <label for="name" class="col-sm-2 control-label">{{ trans('users.user.groups') }} (<span class="required" style="color:red">*</span>) :</label>
                        <div class="col-sm-4">
                            {!! Form::select('groups',$group->toArray(),Request::old('groups'),['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">{{ trans('users.user.password') }} (<span class="required" style="color:red">*</span>) :</label>
                        <div class="col-sm-4">
                            {!! Form::password('password',['class'=>'form-control','placeholder'=>trans('users.user.password')]) !!}
                        </div>
                        <label for="repassword" class="col-sm-2 control-label">{{ trans('users.user.repassword') }} (<span class="required" style="color:red">*</span>) :</label>
                        <div class="col-sm-4">
                            {!! Form::password('repassword',['class'=>'form-control','placeholder'=>trans('users.user.repassword')]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-sm-2 control-label">{{ trans('users.user.status') }} (<span class="required" style="color:red">*</span>) :</label>
                        <div class="col-sm-4">
                            {!! Form::select('status',['1'=>trans('systems.action.active'),'0'=>trans('systems.action.deactive')],Request::old('status'),['class'=>'form-control']) !!}
                        </div>

                    </div>
                    <div class="box-footer">
                        {!! Html::link(route( 'admin.user.index' ), trans('systems.cancel'), ['class' => 'btn btn-default']) !!}
                        {!! Form::submit(trans('systems.save'), ['class' => 'btn btn-primary']) !!}
                        <span class="label label-danger message"></span>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection