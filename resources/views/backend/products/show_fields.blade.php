<!-- Id Field -->

<tr>
    <td>Id:</td>
    <td>{!! $product->id !!}</td>
</tr>


<!-- Name Field -->

<tr>
    <td>Tên:</td>
    <td>{!! $product->name !!}</td>
</tr>


<!-- Img Path Field -->

<tr>
    <td>Ảnh:</td>
    <td>{!! Html::image(\App\Models\BaseModel::getImage( $product->img_path) , '',['style' => 'width:80px; height:80px']); !!}</td>
</tr>


<!-- Price Field -->

<tr>
    <td>Giá:</td>
    <td>{!! \App\Define\Systems::formatPrice($product->price) !!}</td>
</tr>


<!-- New Price Field -->

<!--<tr>
    <td>Giá mới:</td>
    <td>{!! \App\Define\Systems::formatPrice($product->new_price) !!}</td>
</tr>-->

<!-- Amount Field -->

<tr>
    <td>Số lượng:</td>
    <td>{!! $product->amount !!}</td>
</tr>


<!-- Content Field -->

<tr>
    <td>Hàm lượng:</td>
    <td>{!! $product->content !!}</td>
</tr>


<!-- Chemicals Field -->

<tr>
    <td>Hoá chất:</td>
    <td>{!! $product->chemicals !!}</td>
</tr>


<!-- Packaging Field -->

<tr>
    <td>Đóng gói:</td>
    <td>{!! $product->packaging !!}</td>
</tr>


<!-- Manufacturer Field -->

<tr>
    <td>Hãng sản xuất:</td>
    <td>{!! $product->manufacturer !!}</td>
</tr>


<!-- Created At Field -->

<tr>
    <td>Ngày tạo:</td>
    <td>{!! $product->created_at !!}</td>
</tr>


<!-- Updated At Field -->

<tr>
    <td>Ngày cập nhật:</td>
    <td>{!! $product->updated_at !!}</td>
</tr>


