<!-- Id Field -->

<tr>
    <td>Id:</td>
    <td>{!! $promotion->id !!}</td>
</tr>

<!-- Img Path Field -->

<tr>
    <td>Img Path:</td>
    <td>{!! Html::image(\App\Models\BaseModel::getImage( $promotion->img_path) , '',['style' => 'width:80px; height:80px']); !!}</td>
</tr>


<!-- Content Field -->

<tr>
    <td>Content:</td>
    <td>{!! $promotion->content !!}</td>
</tr>


<!-- Code Field -->

<tr>
    <td>Code:</td>
    <td>{!! $promotion->code !!}</td>
</tr>


<!-- Value Field -->

<tr>
    <td>Value:</td>
    <td>{!! $promotion->value !!}</td>
</tr>


<!-- Created At Field -->

<tr>
    <td>Created At:</td>
    <td>{!! $promotion->created_at !!}</td>
</tr>


<!-- Updated At Field -->

<tr>
    <td>Updated At:</td>
    <td>{!! $promotion->updated_at !!}</td>
</tr>


