<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-search"></i> Advance Search</h3>
    </div>
    <div class="box-body">
        <div class="invoice-search row">
            {!! Form::open(['URL'=>route('backend.items.index'),
                            'method'=>'GET',
                            'class'=>'']) !!}
            <div class="col-md-12">
                <div class='row'>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username" class="col-sm-3 control-label label-text-right">{!! trans('app.item_name') !!}:</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-full">
                                    {!! Form::text('name',Request::get('name'),['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label label-text-right">{!! trans('app.furigana') !!}:</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-full">
                                    {!! Form::text('furigana', Request::old('furigana'),['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class="col-md-6">
                        <label class="col-sm-3 control-label label-text-right">{!! trans('app.category') !!}:</label>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <div class="input-group input-group-full">
                                    {!! Form::select('category_id', ['' => ''] +\App\Models\CategoryItem::getListCategory()->toArray() ,Request::old('category_id'),['id' => 'category_id', 'class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-sm-3 control-label label-text-right">{!! trans('app.price') !!}:</label>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <div class="form-inline input-group-full">
                                        {!! Form::text('point_min', Request::old('point_min'),['class'=>'form-control']) !!}
                                        ~
                                        {!! Form::text('point_max', Request::old('point_max'),['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label label-text-right">{!! trans('app.start_time') !!}:</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-full">
                                    {!! Form::text('start_time', Request::old('start_time'),['class'=>'form-control', 'id'=>'start_time']) !!}
                                    <label class="input-group-addon btn" for="date">
                                        <span class="fa fa-calendar open-datetimepicker"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label label-text-right">{!! trans('app.end_time') !!}:</label>
                            <div class="col-sm-9">
                                <div class="input-group input-group-full">
                                    {!! Form::text('end_time', Request::old('end_time'),['class'=>'form-control', 'id'=>'end_time']) !!}
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