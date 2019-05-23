<?php use App\Models\BaseModel;?>
<div class="col-md-5">
    <div class="box box-primary">
        <div class="box-body">
            <!-- Name Field -->
            <div class="form-group">
                {!! Form::label('name', trans('app.name').':') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'style'=>'width:500px']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('furigana', trans('app.furigana').':') !!}
                {!! Form::text('furigana', null, ['class' => 'form-control', 'style'=>'width:500px']) !!}
            </div>

            <!-- Avatar Field -->
            <div class="form-group">
                {!! Form::label('avatar', trans('app.avatar').':') !!}
                {!! Form::file('avatar', ['class' => 'form-control', 'style'=>'width:300px']) !!}
                <?php
                if ( isset($item) && !empty($item->avatar)) {
                    echo Html::image(\App\Models\BaseModel::getImage( $item->avatar) , '',['style' => 'width:80px; height:80px']);
                    echo "<br/>";
                } else {
                    echo '<img class="thumbnail" src="http://placehold.it/100x100" alt="" width="100" height="100" />';
                }
                ?>
            </div>

            <!-- Point Field -->
            <div class="form-group">
                {!! Form::label('point', trans('app.point').':') !!}
                {!! Form::number('point', null, ['class' => 'form-control', 'style'=>'width:500px']) !!}
            </div>

            <!-- Status Field -->
            <div class="form-group">
                {!! Form::label('status', trans('app.status').':', ['class' => 'control-label']) !!}
                {!! Form::select('status', \App\Models\BaseModel::getStatusList(), isset($item) ? intval($item->status) : null, ['class' => 'form-control', 'style'=>'width:300px']) !!}
            </div>

            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit(trans('app.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{!! route('backend.items.index') !!}" class="btn btn-default">{!! trans('app.cancel') !!}</a>
            </div>
        </div>
    </div>
</div>

<div class="col-md-7">
    <div class="box box-primary">
        <div class="box-body">
            <div class="form-group">
                {!! Form::label('category_id', trans('app.category').'(*)', ['class' => 'control-label']) !!}
                {!! Form::select('category_id', ['' =>'']+\App\Models\CategoryItem::getListCategory()->toArray(), isset($item) ? intval($item->category_id) : null , ['required', 'id' => 'category_id', 'class' => 'form-control', 'style'=>'width:300px']) !!}

            </div>

            <!-- Position Field -->
            <div class="form-group">
                {!! Form::label('position', trans('app.position').':', ['class' => 'control-label']) !!}
                {!! Form::select('position', ['' =>'']+\App\Models\BaseModel::getPositionList(), isset($item) ? intval($item->position) : null, ['class' => 'form-control', 'style'=>'width:300px']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('sale_time', trans('app.sale_time').':', ['class' => 'control-label']) !!}
                <div class="row">
                    <div class="col-md-5">
                        <div class="input-group input-group-full" style="max-width: 400px">
                            {!! Form::text('start_buying', Request::old('start_buying'),['class'=>'form-control', 'id'=>'start_buying']) !!}
                            <label class="input-group-addon btn" for="date">
                                <span class="fa fa-calendar open-datetimepicker"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-1">
                    ~
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-full" style="max-width: 400px">
                            {!! Form::text('end_buying', Request::old('end_buying'),['class'=>'form-control', 'id'=>'end_buying']) !!}
                            <label class="input-group-addon btn" for="date">
                                <span class="fa fa-calendar open-datetimepicker"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('is_set', trans('app.is_set').':', ['class' => 'control-label']) !!}
                {!! Form::checkbox('is_set', 1, (isset($item) && $item->is_set) ? true:false, ['class' => 'control-label', 'onclick' => 'showFormSet()']) !!}
            </div>

            <div id="frmItemSet" class="row" style="display: {!! (isset($item) && $item->is_set)? "block": "none" !!} ">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"><b> {!! trans('app.item') !!} in set: </b></h3>&nbsp;
                            <button type="button" class="btn btn-success btn-xs" id="btAddItem"/>{!! trans('app.create') !!} {!! trans('app.item') !!}</button>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="tableItemSet" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{!! trans('app.avatar') !!}</th>
                                    <th>{!! trans('app.name') !!}</th>
                                    <th>{!! trans('app.point') !!}</th>
                                    <th>{!! trans('app.position') !!}</th>
                                    <th style="width: 20px">{!! trans('app.action') !!}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(isset($item) && $item->is_set==1){
                                            $itemSet = \App\Models\Item::where('parent_id', $item->id)->get();
                                        }

                                        if(isset($itemSet)){
                                            foreach ($itemSet as $itm){
                                    ?>
                                    <tr id="{!! $itm->id !!}">
                                        <td><input type="hidden" name="itemSetId[]" value="{!! $itm->id !!}">#</td>
                                        <td>
                                            {!! Form::file('set_avatar[]', ['class' => 'form-control', 'style'=>'width:200px'] ) !!}
                                            <?php
                                            if ( isset($itm) && !empty($itm->avatar)) {
                                                echo Html::image(\App\Models\BaseModel::getImage( $itm->avatar) , '',['style' => 'width:48px;']);
                                                echo "<br/>";
                                            } else {
                                                echo '<img class="thumbnail" src="http://placehold.it/100x100" alt="" width="48"/>';
                                            }
                                            ?>
                                        </td>
                                        <td>{!! Form::text('set_name[]', $itm->name, ['class' => 'form-control', 'style'=>'width:100%']) !!}</td>
                                        <td>{!! Form::number('set_point[]', $itm->point, ['class' => 'form-control', 'style'=>'width:100%']) !!}</td>
                                        <td>{!! Form::select('set_position[]', ['' =>'']+BaseModel::getPositionList(), $itm->position, ['required', 'class' => 'form-control']) !!}</td>
                                        <td><a href="#" class="btn btn-default btn-xs" onclick="removeItem('{!! $itm->id !!}')"><i class="glyphicon glyphicon-trash"></i></a></td>
                                    </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Field -->
            <div class="form-group">
                {!! Form::label('description', trans('app.description').':') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'size' => '30x2']) !!}
            </div>
        </div>
    </div>
</div>

@section('child-scripts')
    <style>
        .select2-selection__choice{
            color: #000 !important;
        }
    </style>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

    <script type="text/javascript">
//        $('#category_id').select2({
//        });
//        var valueSelect = JSON.parse("[" + $('#select2').val() + "]");
//        var s2 = $('#category_id').select2({
//            multiple: false,
//            allowClear: false,
//        });
//        s2.val( valueSelect ).trigger("change");

    var indx = 1;
    $('#btAddItem').on('click', function(event){
        $('#tableItemSet').append('<tr id="'+indx+'">' +
            '<td><input type="hidden" name="itemSetId[]" value="0">#</td>'
            +'<td>{!! Form::file('set_avatar[]', ['required', 'class' => 'form-control', 'style'=>'width:200px'] ) !!}</td>'
            +'<td>{!! Form::text('set_name[]', null, ['class' => 'form-control', 'style'=>'width:100%']) !!}</td>'
            +'<td>{!! Form::number('set_point[]', null, ['required', 'class' => 'form-control', 'style'=>'width:100%']) !!}</td>'
            +'<td>{!! Form::select('set_position[]', ['' =>'']+BaseModel::getPositionList(), '', ['required', 'class' => 'form-control']) !!}</td>'
            +'<td><a href="#" class="btn btn-default btn-xs" onclick="removeItem('+indx+')"><i class="glyphicon glyphicon-trash"></i></a></td>'
            +'</tr>');
        indx++;
    });

    function removeItem(val) {
        $('#tableItemSet tr#'+val).remove();
        indx--;
    }

    function showFormSet() {
        $(document).on('change', '#is_set', function() {
            if(this.checked) {
                $("#frmItemSet").css("display", "block");
            } else {
                $("#frmItemSet").css("display", "none");
            }
        });
    }

    $('#start_buying').datepicker({
        dateFormat: 'yy-mm-dd',
    });

    $('#end_buying').datepicker({
        dateFormat: 'yy-mm-dd'
    });

    </script>
@stop