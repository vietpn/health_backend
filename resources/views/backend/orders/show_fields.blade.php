<!-- Id Field -->

<tr>
    <td>Id:</td>
    <td>
        <?php
        $createdAt = new \DateTime($order->created_at);
        if ($createdAt) {
            echo $createdAt->format("ymdHis");
        } else {
            echo $order->id;
        }
        ?>
    </td>
</tr>


<!-- Profile Id Field -->

<tr>
    <td>Username:</td>
    <td>{!! $order->username !!}</td>
</tr>


<!-- Total Price Field -->

<tr>
    <td>Giá:</td>
    <td>{!! \App\Define\Systems::formatPrice($order->total_price) !!}</td>
</tr>


<!-- Promo Code Field -->

<tr>
    <td>Mã KM:</td>
    <td>{!! $order->promo_code !!}</td>
</tr>


<!-- Status Field -->

<tr>
    <td>Trạng thái:</td>
    <td>{!! \App\Models\BaseModel::getStatusName($order->status) !!}</td>
</tr>


<!-- Created At Field -->

<tr>
    <td>Ngaỳ tạo:</td>
    <td>{!! $order->created_at !!}</td>
</tr>


<!-- Updated At Field -->

<tr>
    <td>Ngày cập nhật:</td>
    <td>{!! $order->updated_at !!}</td>
</tr>


