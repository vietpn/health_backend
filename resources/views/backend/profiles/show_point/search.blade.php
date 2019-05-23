@section('css')
    {!! Html::style('assets/plugins/datepicker/datepicker3.css') !!}
    {!! Html::style('assets/plugins/daterangepicker/daterangepicker.css') !!}
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
                        <label for="username" class="col-sm-3 control-label">{!! __('profiles.type_point') !!}
                            : </label>
                        <div class="col-sm-9">
                            <div class="form-group" style="margin-left: 1px;">
                                <label>
                                    {!! Form::radio('type_point',1,Request::get('type_point'),['class'=>'minimal','checked'=>(Request::get('type_point')==1)?true:false]) !!}
                                    &nbsp;{!! __('profiles.is_plus') !!}
                                </label>

                                <label style="margin-left: 15px">
                                    {!! Form::radio('type_point',0,Request::get('type_point'),['class'=>'minimal','checked'=>(Request::get('type_point')==0)?true:false]) !!}
                                    &nbsp;{!! __('profiles.is_minus') !!}
                                </label>
                            </div>
                        </div>
                        <!-- /.input group -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username" class="col-sm-3 control-label">Time : </label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                {!! Form::text('time',Request::get('time'),['class'=>'form-control pull-right','id'=>'reservation']) !!}
                            </div>
                            {{--<div class="form-group" style="margin-left: 1px;">--}}
                                {{--{!! Form::text('location',Request::get('location'),['class'=>'form-control']) !!}--}}
                            {{--</div>--}}
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
@section('scripts')
    {!! Html::script('assets/plugins/moment/min/moment.min.js') !!}
    {!! Html::script('assets/plugins/daterangepicker/daterangepicker.js') !!}
    {!! Html::script('assets/plugins/iCheck/icheck.min.js') !!}
    <script>
        !function ($) {
            $(function () {
                //Date picker
                $('#reservation').daterangepicker({
                    autoClose: false,
                    format: 'YYYY-MM-DD'
                });
                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal-blue',
                    radioClass: 'iradio_minimal-blue'
                })
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                })
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                })

            });
        }(window.jQuery);

    </script>
@endsection


