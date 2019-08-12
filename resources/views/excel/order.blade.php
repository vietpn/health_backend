<html>
<!--{{ Html::style('/css/excel.css') }}-->
<body>
<tr>
    <td rowspan="3"></td>
    <td colspan="4" align="center" style="font-weight: bold; font-size: 16">C.ty TNHH MTV Dược phẩm Trọng Tín</td>
</tr>
<tr>
    <td></td>
    <td colspan="4" align="center" style="">Lô 46 MBQH 90 Phường Đông Vệ-tp Thanh Hóa-Thanh Hóa</td>
</tr>
<tr></tr>
<tr>
    <td align="center"><strong>ID</strong></td>
    <td colspan="4" align="center">
        <?php
        $createdAt = new \DateTime($order->created_at);
        if ($createdAt) {
            echo "'" . $createdAt->format("ymdHis");
        } else {
            echo $order->id;
        }
        ?>
    </td>
</tr>
<tr>
    <td align="center"><strong>Khách Hàng</strong></td>
    <td colspan="4" align="center">{!! $order->username !!}</td>
</tr>
<tr>
    <td align="center"><strong>Tên Khách Hàng</strong></td>
    <td colspan="4" align="center">{!! $order->name !!}</td>
</tr>
<tr>
    <td align="center"><strong>Điện Thoại</strong></td>
    <td colspan="4" align="center">{!! $order->phone_number !!}</td>
</tr>
<tr>
    <td align="center"><strong>Địa Chỉ</strong></td>
    <td colspan="4" align="center"></td>
</tr>
<tr>
    <td align="center"><strong>Mã KM</strong></td>
    <td colspan="4" align="center">{!! $order->promo_code !!}</td>
</tr>
<tr>
    <td align="center"><strong>Gía Trị</strong></td>
    <td colspan="4" align="center">VND {!! \App\Define\Systems::formatPrice($order->total_price)!!}</td>
</tr>
<tr>
    <td align="center"><strong>Ngày Tạo</strong></td>
    <td colspan="4" align="center">{!! $order->created_at !!}</td>
</tr>

<tr></tr>
<tr>
    <th align="center">STT</th>
    <th align="center">Tên sản phẩm</th>
    <th align="center">Số lượng</th>
    <th align="center">Giá</th>
    <th align="center">Thành tiền</th>
</tr>
<?php $i = 1; ?>
<?php foreach ($orderDetails as $orderDetail) { ?>
    <tr>
        <td align="center">{!! $i !!}</td>
        <td align="center">{!! $orderDetail['product_id']['name'] !!}</td>
        <td align="center">{!! $orderDetail->amount !!}</td>
        <td align="center">{!! \App\Define\Systems::formatPrice($orderDetail['product_id']['price']) !!}</td>
        <td align="center">{!! \App\Define\Systems::formatPrice($orderDetail->amount *
            $orderDetail['product_id']['price']) !!}
        </td>
    </tr>
    <?php $i++; ?>
<?php } ?>
<tr></tr>
<tr></tr>
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td align="center"><strong>Tổng tiền</strong></td>
    <td align="center">{!! \App\Define\Systems::formatPrice($order->total_price)!!}</td>
</tr>
</body>
</html>