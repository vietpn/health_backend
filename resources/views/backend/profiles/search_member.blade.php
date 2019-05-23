@section('css')
    {!! Html::style('assets/plugins/datepicker/datepicker3.css') !!}
    <!-- iCheck for checkboxes and radio inputs -->
    {!! Html::style('assets/plugins/iCheck/all.css') !!}
@endsection
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-search"></i>{!! __('profiles.condition_search') !!}</h3>
    </div>
    <div class="box-body">
        <div class="invoice-search">
            {!! Form::open(['URL'=>route('backend.ngWords.index'),'method'=>'GET','class'=>'form-horizontal']) !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">{!! __('profiles.name') !!} : </label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                {!! Form::text('name',Request::get('name'),['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">{!! __('profiles.last_login') !!}
                            : </label>
                        <div class="col-sm-9">
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {!! Form::text('last_login',Request::get('last_login'),['class'=>'form-control pull-right','id'=>'datepicker']) !!}
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">{!! __('profiles.username') !!} : </label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                {!! Form::text('username',Request::get('username'),['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">{!! __('profiles.black_user') !!}
                            : </label>
                        <div class="col-sm-9">
                            <div class="form-group" style="margin-left: 1px;">
                                <label>
                                    {!! Form::radio('black_user',1,Request::get('black_user'),['class'=>'minimal','checked'=>true]) !!}
                                    &nbsp;Yes
                                </label>

                                <label style="margin-left: 15px">
                                    {!! Form::radio('black_user',0,Request::get('black_user'),['class'=>'minimal','checked'=>false]) !!}
                                    &nbsp;No
                                </label>
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">{!! __('profiles.gender') !!} : </label>
                        <div class="col-sm-9">
                            <div class="form-group" style="margin-left: 1px;">
                                <label>
                                    {!! Form::radio('gender',1,Request::get('gender'),['class'=>'minimal','checked'=>true]) !!}
                                    &nbsp;Men
                                </label>

                                <label style="margin-left: 15px">
                                    {!! Form::radio('gender',0,Request::get('gender'),['class'=>'minimal','checked'=>false]) !!}
                                    &nbsp;Girl
                                </label>
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">{!! __('profiles.member_rank') !!}
                            : </label>
                        <div class="col-sm-9">
                            <div class="form-group" style="margin-left: 1px;">
                                {!! Form::select('member_rank',[
                                    1=>'1',
                                    2=>'2',
                                ],Request::get('member_rank'),['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">{!! __('profiles.location') !!} : </label>
                        <div class="col-sm-9">
                            <div class="form-group" style="margin-left: 1px;">
                                {!! Form::text('location',Request::get('location'),['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">{!! __('profiles.is_business') !!}
                            : </label>
                        <div class="col-sm-9">
                            <div class="form-group" style="margin-left: 1px;">
                                <label>
                                    {!! Form::radio('is_business',1,Request::get('is_business'),['class'=>'minimal','checked'=>(Request::get('is_business')==1)?true:false]) !!}
                                    &nbsp;{!! __('profiles.bussines_account') !!}
                                </label>

                                <label style="margin-left: 15px">
                                    {!! Form::radio('is_business',0,Request::get('is_business'),['class'=>'minimal','checked'=>(Request::get('is_business')==0)?true:false]) !!}
                                    &nbsp;{!! __('profiles.normal_account') !!}
                                </label>
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">{!! __('profiles.age') !!} : </label>
                        <div class="col-sm-2">
                            <div class="form-group" style="margin-left: 1px;">
                                {!! Form::select('from_age',[null=>'From Age']+$age,Request::get('from_age'),['class'=>'form-control','id'=>'from_age']) !!}
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="text-center">
                                <i class="fa fa-arrows-h" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group" style="margin-left: 1px;">
                                {!! Form::select('to_age',[null=>'To Age']+$age,Request::get('to_age'),['class'=>'form-control','id'=>'to_age']) !!}
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    {!! form::submit(__('systems.search'), ['class' => 'btn btn-success']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>