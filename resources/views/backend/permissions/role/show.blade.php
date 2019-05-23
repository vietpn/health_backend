@extends('layouts.app')

@section('child-header')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    {!! Html::style('vendor/adminlte/plugins/iCheck/all.css') !!}
@endsection
@section('content')
    <div class="content">
        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-home"></i>{!! trans('systems.roles.detail') !!} : {!! $group->name !!}</h3>

            </div>
            <div class="box-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                {!! Form::open(['url' => route('admin.roles.update',$group->id),'method'=>'PUT']) !!}
                <div class="form-group">
                    {!! Form::label('name', trans('users.name'), ['class' => 'control-label']) !!}
                    {!! Form::text('name', Request::old('name',$group->name), array('class'=>'form-control','placeholder'=>trans('users.name'),'readonly'=>true)) !!}
                </div>
                <div class="form-group">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th rowspan="2" style="text-align: center;" >#</th>
                                <th rowspan="2" >Module</th>
                                <th colspan="4" style="text-align: center;" >{!! trans('users.list_permission') !!}</th>
                            </tr>
                            <tr>

                                <th>{!! trans('app.view') !!}</th>
                                <th>{!! trans('app.create') !!}</th>
                                <th>{!! trans('app.update') !!}</th>
                                <th>{!! trans('app.Delete') !!}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1;?>
                            @foreach($permissions as $key=>$value)
                                <tr>
                                    <td>{!! $i++ !!}</td>
                                    <td>{!! trans('users.group.'.str_replace( '.', '.', $key )) !!}</td>
                                    <td><input type="checkbox" value="{!! $key.'.view' !!}" name="permissions[]" @if(isset($group->permissions[$key.'.view']) && $group->permissions[$key.'.view']==1) checked @endif @if(!in_array('view',$value)) disabled @endif></td>
                                    <td><input type="checkbox" value="{!! $key.'.create' !!}" name="permissions[]" @if(isset($group->permissions[$key.'.create']) && $group->permissions[$key.'.create']==1) checked @endif @if(!in_array('create',$value)) disabled @endif></td>
                                    <td><input type="checkbox" value="{!! $key.'.update' !!}" name="permissions[]" @if(isset($group->permissions[$key.'.update']) && $group->permissions[$key.'.update']==1) checked @endif @if(!in_array('update',$value)) disabled @endif></td>
                                    <td><input type="checkbox" value="{!! $key.'.destroy' !!}" name="permissions[]" @if(isset($group->permissions[$key.'.destroy']) && $group->permissions[$key.'.destroy']==1) checked @endif @if(!in_array('destroy',$value)) disabled @endif></td>
                                    @foreach($value as $k=>$v)
                                        @if(!in_array($v,['view','create','update','destroy']))
                                            <td><input type="checkbox" value="{!! $key.'.'.$v !!}" name="permissions[]" @if(isset($group->permissions[$key.'.'.$v]) && $group->permissions[$key.'.'.$v]==1) checked @endif>{!! $v !!} </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                {!! Form::close() !!}

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
@endsection
@section('child-scripts')
    {!! Html::script('https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js') !!}
    <script>
//        $(function () {
//            $('input').iCheck({
//                checkboxClass: 'icheckbox_flat-green',
//                radioClass: 'iradio_flat-green',
//                increaseArea: '20%' // optional
//            });
//        });
    </script>
@endsection