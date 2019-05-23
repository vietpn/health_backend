<!-- Id Field -->

<tr>
    <td>Id:</td>
    <td>{!! $item->id !!}</td>
</tr>


<!-- Name Field -->

<tr>
    <td>{!! trans('app.name') !!}:</td>
    <td>{!! $item->name !!}</td>
</tr>

<tr>
    <td>{!! trans('app.furigana') !!}:</td>
    <td>{!! $item->furigana !!}</td>
</tr>

<tr>
    <td>{!! trans('app.avatar') !!}:</td>
    <td><?php
        if ( isset($item) && !empty($item->avatar)) {
            echo Html::image(\App\Models\BaseModel::getImage( $item->avatar) , '',['style' => 'width:80px; height:80px']);
            echo "<br/>";
        } else {
            echo '<img class="thumbnail" src="http://placehold.it/100x100" alt="" width="100" height="100" />';
        }
        ?>
    </td>
</tr>


<!-- Point Field -->

<tr>
    <td>{!! trans('app.point') !!}:</td>
    <td>{!! $item->point !!}</td>
</tr>


<!-- Description Field -->

<tr>
    <td>{!! trans('app.description') !!}:</td>
    <td>{!! $item->description !!}</td>
</tr>

<tr>
    <td>{!! trans('app.position') !!}:</td>
    <td>{!! \App\Models\BaseModel::getPositionName($item->position) !!}</td>
</tr>

<tr>
    <td>{!! trans('app.category') !!}:</td>
    <td>{!! $item->category->title !!}</td>
</tr>

<tr>
    <td>{!! trans('app.start_buying') !!}:</td>
    <td>{!! $item->start_buying !!}</td>
</tr>

<tr>
    <td>{!! trans('app.end_buying') !!}:</td>
    <td>{!! $item->end_buying !!}</td>
</tr>

<tr>
    <td>{!! trans('app.status') !!}:</td>
    <td>{!! $item->status !!}</td>
</tr>

<!-- Created At Field -->

<tr>
    <td>{!! trans('app.created_at') !!}:</td>
    <td>{!! $item->created_at !!}</td>
</tr>


<!-- Updated At Field -->

<tr>
    <td>{!! trans('app.updated_at') !!}:</td>
    <td>{!! $item->updated_at !!}</td>
</tr>


<!-- Created Id Field -->

<tr>
    <td>{!! trans('app.created_id') !!}:</td>
    <td>{!! $item->created_id !!}</td>
</tr>


<!-- Updated Id Field -->

<tr>
    <td>{!! trans('app.updated_id') !!}:</td>
    <td>{!! $item->updated_id !!}</td>
</tr>


