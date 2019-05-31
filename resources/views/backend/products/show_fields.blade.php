<!-- Id Field -->

<tr>
    <td>Id:</td>
    <td>{!! $product->id !!}</td>
</tr>


<!-- Name Field -->

<tr>
    <td>Name:</td>
    <td>{!! $product->name !!}</td>
</tr>


<!-- Img Path Field -->

<tr>
    <td>Img Path:</td>
    <td>{!! Html::image(\App\Models\BaseModel::getImage( $product->img_path) , '',['style' => 'width:80px; height:80px']); !!}</td>
</tr>


<!-- Price Field -->

<tr>
    <td>Price:</td>
    <td>{!! \App\Define\Systems::formatPrice($product->price) !!}</td>
</tr>


<!-- New Price Field -->

<tr>
    <td>New Price:</td>
    <td>{!! \App\Define\Systems::formatPrice($product->new_price) !!}</td>
</tr>

<!-- Amount Field -->

<tr>
    <td>Amount:</td>
    <td>{!! $product->amount !!}</td>
</tr>


<!-- Content Field -->

<tr>
    <td>Content:</td>
    <td>{!! $product->content !!}</td>
</tr>


<!-- Chemicals Field -->

<tr>
    <td>Chemicals:</td>
    <td>{!! $product->chemicals !!}</td>
</tr>


<!-- Packaging Field -->

<tr>
    <td>Packaging:</td>
    <td>{!! $product->packaging !!}</td>
</tr>


<!-- Manufacturer Field -->

<tr>
    <td>Manufacturer:</td>
    <td>{!! $product->manufacturer !!}</td>
</tr>


<!-- Created At Field -->

<tr>
    <td>Created At:</td>
    <td>{!! $product->created_at !!}</td>
</tr>


<!-- Updated At Field -->

<tr>
    <td>Updated At:</td>
    <td>{!! $product->updated_at !!}</td>
</tr>


