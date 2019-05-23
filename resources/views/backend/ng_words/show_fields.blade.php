<!-- Id Field -->

<tr>
    <td>Id:</td>
    <td>{!! $ngWord->id !!}</td>
</tr>


<!-- Word Field -->

<tr>
    <td>Word:</td>
    <td>{!! $ngWord->word !!}</td>
</tr>


<!-- Pronounce Field -->

<tr>
    <td>Pronounce:</td>
    <td>{!! $ngWord->pronounce !!}</td>
</tr>


<!-- Description Field -->

<tr>
    <td>Description:</td>
    <td>{!! $ngWord->description !!}</td>
</tr>


<!-- Status Field -->

<tr>
    <td>Status:</td>
    <td>{!! \App\Models\BaseModel::getStatusName($ngWord->status) !!}</td>
</tr>


<!-- Created Id Field -->

<tr>
    <td>Created Id:</td>
    <td>{!! $ngWord->created_id !!}</td>
</tr>


<!-- Created At Field -->

<tr>
    <td>Created At:</td>
    <td>{!! $ngWord->created_at !!}</td>
</tr>


<!-- Updated Id Field -->

<tr>
    <td>Updated Id:</td>
    <td>{!! $ngWord->updated_id !!}</td>
</tr>


<!-- Updated At Field -->

<tr>
    <td>Updated At:</td>
    <td>{!! $ngWord->updated_at !!}</td>
</tr>


