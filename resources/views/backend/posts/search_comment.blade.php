<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-search"></i> Comment Search</h3>
    </div>
    <div class="box-body">
        <div class="invoice-search row">
            {!! Form::open(['URL'=>route('backend.posts.show', $post->id),
                            'method'=>'GET',
                            'class'=>'']) !!}
            <div class='row'>
                <div class="col-md-12">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Profile name:</label>
                            <span class="input-icon icon-right">
                            <div style="position: relative">
                                {!! Form::text('profile_name', Request::old('profile_name'),['class'=>'form-control']) !!}
                            </div>
                        </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Age:</label>
                            <span class="input-icon icon-right">
                            <div style="position: relative">
                                {!! Form::text('birth_year', Request::old('birth_year'),['class'=>'form-control']) !!}
                            </div>
                        </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Gender:</label>
                            <span class="input-icon icon-right">
                            <div style="position: relative">
                                {!! Form::select('gender', array('1' => 'Male', '0' => 'Female', ''=> 'Other'), Request::old('gender'),['class'=>'form-control']) !!}
                            </div>
                        </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Content:</label>
                            <span class="input-icon icon-right">
                            <div style="position: relative">
                                {!! Form::text('content', Request::old('content'),['class'=>'form-control']) !!}
                            </div>
                        </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Start time :</label>
                            <div class="input-group">
                                {!! Form::text('start_time', Request::old('start_time', $start_time),['class'=>'form-control', 'id'=>'start_time']) !!}
                                <label class="input-group-addon btn" for="date">
                                    <span class="fa fa-calendar open-datetimepicker"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">End time :</label>

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