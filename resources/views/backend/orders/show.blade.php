@extends('layouts.app')

@section('header')
<section class="content-header">
    <h1>
        @yield('breadcrumb_title') <span class="text-lowercase">{{ '' }}</span>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ '' }}" class="text-capitalize">{{ '' }}</a></li>
        <li class="active">{{ '' }}</li>
    </ol>

</section>
@endsection

@section('content')
<section class="content-header">
    <h1>
        Đơn hàng
    </h1>
</section>
<div class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-home"></i>Chi tiết #<?= $order->id ?></h3>
            <div>
                <a href="{!! route('backend.orders.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <div class="box-body">
            <div class="row" style="padding-left: 20px; padding-right: 20px">
                <table class="table table-striped table-bordered table-hover">
                    @include('backend.orders.show_fields')
                </table>

                <div class="row" style="padding-left: 20px; padding-right: 20px">
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>ID</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                        </tr>
                        <?php foreach ($orderDetails as $orderDetail) { ?>
                            <tr>
                                <td>{!! $orderDetail['product_id']['id'] !!}</td>
                                <td>{!! $orderDetail['product_id']['name'] !!}</td>
                                <td>{!! Html::image($orderDetail['product_id']['img_path'], '',['style' => 'width:80px; height:80px']); !!}</td>
                                <td>{!! $orderDetail->amount !!}</td>
                                <td>{!! \App\Define\Systems::formatPrice($orderDetail['product_id']['price']) !!}</td>
                            </tr>
                        <?php } ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
