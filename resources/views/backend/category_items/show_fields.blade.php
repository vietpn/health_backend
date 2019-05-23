<!-- Id Field -->

<tr>
    <td>Id:</td>
    <td>{!! $categoryItem->id !!}</td>
</tr>


<!-- Title Field -->

<tr>
    <td>{!! trans('app.title') !!}:</td>
    <td>{!! $categoryItem->title !!}</td>
</tr>


<!-- Avatar Field -->

<tr>
    <td>{!! trans('app.avatar') !!}:</td>
    <td>
        <?php
        if ( isset($categoryItem) && !empty($categoryItem->avatar)) {
            echo Html::image(\App\Models\BaseModel::getImage( $categoryItem->avatar) , '',['style' => 'width:80px; height:80px']);
            echo "<br/>";
        } else {
            echo '<img class="thumbnail" src="http://placehold.it/100x100" alt="" width="100" height="100" />';
        }
        ?>
    </td>
</tr>

<tr>
    <td>{!! trans('app.sort_order') !!}:</td>
    <td>{!! $categoryItem->sort_oder !!}</td>
</tr>

<!-- Type Field -->

<tr>
    <td>{!! trans('app.type') !!}:</td>
    <td>{!! \App\Models\BaseModel::getCategoryTypeName($categoryItem->type) !!}</td>
</tr>

<!-- Status Field -->

<tr>
    <td>{!! trans('app.status') !!}:</td>
    <td>{!! \App\Models\BaseModel::getStatusName($categoryItem->status) !!}</td>
</tr>


<!-- Created At Field -->

<tr>
    <td>{!! trans('app.created_at') !!}:</td>
    <td>{!! $categoryItem->created_at !!}</td>
</tr>


<!-- Updated At Field -->

<tr>
    <td>{!! trans('app.updated_at') !!}:</td>
    <td>{!! $categoryItem->updated_at !!}</td>
</tr>


<!-- Created Id Field -->

<tr>
    <td>{!! trans('app.created_id') !!}:</td>
    <td>{!! $categoryItem->created_id !!}</td>
</tr>


<!-- Updated Id Field -->

<tr>
    <td>{!! trans('app.updated_id') !!}:</td>
    <td>{!! $categoryItem->updated_id !!}</td>
</tr>


