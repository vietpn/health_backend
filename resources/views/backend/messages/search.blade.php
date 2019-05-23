<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-search"></i> {!! trans('menus.chatMessages') !!}</h3>
    </div>
    <div class="box-body">
        <div class="invoice-search row">
            {!! Form::open(['URL'=>route('backend.messages.index'),
                            'method'=>'GET',
                            'class'=>'']) !!}
            <div class="col-md-12">

                <div class='row'>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="username" class="col-sm-3 control-label label-text-right">{!! trans("message.sender") !!}:</label>
                            <div class="col-sm-6">
                                <div class="input-group input-group-full">
                                    {!! Form::text('sender',Request::get('name'),['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-3 control-label label-text-right">{!! trans("message.receiver") !!}:</label>
                            <div class="col-sm-6">
                                <div class="input-group input-group-full">
                                    {!! Form::text('receiver', Request::old('furigana'),['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-3 control-label label-text-right">{!! trans('app.created_at') !!}
                                :</label>
                            <div class="col-md-3">
                                <div class="input-group">
                                    {!! Form::text('start_time', Request::old('start_time', $start_time),['class'=>'form-control', 'id'=>'start_time']) !!}
                                    <label class="input-group-addon btn" for="date">
                                        <span class="fa fa-calendar open-datetimepicker"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    {!! Form::text('end_time', Request::old('end_time', $end_time),['class'=>'form-control', 'id'=>'end_time']) !!}
                                    <label class="input-group-addon btn" for="date">
                                        <span class="fa fa-calendar open-datetimepicker"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class='row'>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-info">{!! trans('app.search') !!}</button>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!--datepicker-->
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<!--end datepicker-->
<script type="text/javascript">
    $('#start_time').datepicker({
        dateFormat: 'yy-mm-dd',
    });

    $('#end_time').datepicker({
        dateFormat: 'yy-mm-dd'
    });
</script>