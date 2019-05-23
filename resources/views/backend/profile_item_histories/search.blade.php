<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-search"></i> Advance Search</h3>
    </div>
    <div class="box-body">
        <div class="invoice-search row">
            {!! Form::open(['URL'=>route('backend.profileItemHistories.index'),
                            'method'=>'GET',
                            'class'=>'']) !!}
            <div class="col-md-12">
                <div class='row'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{!! trans('app.user_name') !!}:</label>
                                <span class="input-icon icon-right">
                                <div style="position: relative">
                                    {!! Form::text('username', Request::old('username'),['class'=>'form-control']) !!}
                                </div>
                            </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{!! trans('app.item_name') !!}:</label>
                                <span class="input-icon icon-right">
                                <div style="position: relative">
                                    {!! Form::text('item_name', Request::old('item_name'),['class'=>'form-control']) !!}
                                </div>
                            </span>
                            </div>
                        </div>
                </div>
                <div class='row'>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{!! trans('app.start_time') !!}:</label>
                                <div class="input-group">
                                    {!! Form::text('start_time', Request::old('start_time', $start_time),['class'=>'form-control', 'id'=>'start_time']) !!}
                                    <label class="input-group-addon btn" for="date">
                                        <span class="fa fa-calendar open-datetimepicker"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">{!! trans('app.end_time') !!}:</label>

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