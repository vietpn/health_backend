<html>
<table>
    <tr>
        <td><strong>Khách Hàng</strong></td>
        <td align="right">{!! $order->username !!}</td>
    </tr>
    <tr>
        <td><strong>Điện Thoại</strong></td>
        <td align="right">{!! $order->phone_number !!}</td>
    </tr>
    <tr>
        <td><strong>Địa Chỉ</strong></td>
        <td align="right"></td>
    </tr>
    <tr>
        <td><strong>Mã KM</strong></td>
        <td align="right">{!! $order->promo_code !!}</td>
    </tr>
    <tr>
        <td><strong>Gía Trị</strong></td>
        <td align="right">{!! \App\Define\Systems::formatPrice($order->total_price)!!}</td>
    </tr>

    <tr></tr>
    <tr></tr>
    <tr>
        <th>ID</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Giá</th>
    </tr>
    <?php foreach ($orderDetails as $orderDetail) { ?>
        <tr>
            <td>{!! $orderDetail['product_id']['id'] !!}</td>
            <td>{!! $orderDetail['product_id']['name'] !!}</td>
            <td>{!! $orderDetail->amount !!}</td>
            <td>{!! \App\Define\Systems::formatPrice($orderDetail['product_id']['price']) !!}</td>
        </tr>
    <?php } ?>

</table>
</html>