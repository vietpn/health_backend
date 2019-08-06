<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-search"></i>Tìm kiếm sản phẩm</h3>
    </div>
    <div class="box-body">
        <div class="invoice-search row">
            {!! Form::open(['URL'=>route('backend.products.index'),
                            'method'=>'GET',
                            'id'=>'w0',
                            'class'=>'']) !!}

            <div class="col-md-12">
                <div class='row'>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-3 control-label label-text-right">Tên sản phẩm:</label>
                            <div class="col-sm-6">
                                <div class="input-group input-group-full">
                                    {!! Form::text('name', Request::old('name'),['class'=>'form-control']) !!}
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
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
