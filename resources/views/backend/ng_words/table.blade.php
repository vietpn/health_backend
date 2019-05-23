<table class="table table-responsive table-striped table-bordered table-hover" id="ngWords-table">
    <thead>
        {{--<th>ID</th>--}}
        <th>{!! trans('ngWord.ng_word') !!}</th>
        <th>{!! trans('ngWord.pronounce') !!}</th>
        <th>{!! trans('ngWord.created_at') !!}</th>
        <th>{!! trans('ngWord.stype') !!}</th>
        <th>{!! trans('ngWord.status') !!}</th>
        <th>{!! trans('ngWord.edit') !!}</th>
        <th>{!! trans('ngWord.delete') !!}</th>
    </thead>
    <tbody>
    @foreach($ngWords as $ngWord)
        <tr>
            {{--<td>{!! $ngWord->id !!}</td>--}}
            <td>{!! $ngWord->word !!}</td>
            <td>{!! $ngWord->pronounce !!}</td>
            <td>{!! $ngWord->created_at !!}</td>
            <td>{!! \App\Models\BaseModel::getNgWordTypeName($ngWord->type) !!}</td>
            <td>{!! \App\Models\BaseModel::getStatusName($ngWord->status) !!}</td>
            <td>
                <a href="{!! route('backend.ngWords.edit', [$ngWord->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
            </td>
            <td>
                {!! Form::open(['route' => ['backend.ngWords.destroy', $ngWord->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('".trans("ngWord.confirm_delete")."')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $ngWords->appends(['word'=>$word, 'pronounce'=>$pronounce, 'status'=>$status])->render() !!}