<!-- Id Field -->

<tr>
    <td>Id:</td>
    <td>{!! $profileReport->id !!}</td>
</tr>


<!-- Profile Id Field -->

<tr>
    <td>Profile Id:</td>
    <td>{!! $profileReport->profile_id !!}</td>
</tr>


<!-- Profile Id Report Field -->

<tr>
    <td>Profile Id Report:</td>
    <td>{!! $profileReport->profile_id_report !!}</td>
</tr>


<!-- Status Field -->

<tr>
    <td>Status:</td>
    <td>{!! \App\Models\BaseModel::getStatusName($profileReport->status) !!}</td>
</tr>


<!-- Des Field -->

<tr>
    <td>Des:</td>
    <td>{!! $profileReport->des !!}</td>
</tr>


<!-- Created At Field -->

<tr>
    <td>Created At:</td>
    <td>{!! $profileReport->created_at !!}</td>
</tr>


<!-- Updated At Field -->

<tr>
    <td>Updated At:</td>
    <td>{!! $profileReport->updated_at !!}</td>
</tr>


