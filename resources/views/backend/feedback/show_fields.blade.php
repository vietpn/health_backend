<!-- Id Field -->

<tr>
    <td>Id:</td>
    <td>{!! $feedback->id !!}</td>
</tr>


<!-- Profile Id Field -->

<tr>
    <td>Username:</td>
    <td>{!! $feedback->username !!}</td>
</tr>


<!-- Content Field -->

<tr>
    <td>Nội dung:</td>
    <td>{!! $feedback->content !!}</td>
</tr>


<!-- Img Path Field -->

<tr>
    <td>Ảnh:</td>
    <td>
        <?php
        $arrImg = explode(',', $feedback->img_path);
        if (!empty($arrImg)) {
            foreach ($arrImg as $img) {
                echo Html::image($img, '', ['style' => 'width:80px; height:80px']);
            }
        } else {
            echo Html::image($feedback->img_path, '', ['style' => 'width:80px; height:80px']);
        } ?>
    </td>
</tr>


<!-- Created At Field -->

<tr>
    <td>Ngày tạo:</td>
    <td>{!! $feedback->created_at !!}</td>
</tr>


<!-- Updated At Field -->

<tr>
    <td>Ngày cập nhật:</td>
    <td>{!! $feedback->updated_at !!}</td>
</tr>


