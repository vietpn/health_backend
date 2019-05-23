@extends('layouts.app')


@section('content')
    <div class="container-fluid spark-screen">
        <div class="row">
            <div class="content">
                <div class="clearfix"></div>

                @include('flash::message')

                <div class="clearfix"></div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-home"></i>{!! trans('users.role.list_role') !!}</h3>
                    </div>
                    <div class="box-body">
                        <p>
                            {{ Html::link(URL::route('admin.user.create'), trans('systems.create'), array('class' => 'btn btn-primary')) }}
                        </p>

                        <div class="text-right">
                            <div class="row">
                                <div class="col-md-3 text-left">
                                    {{ $users->firstItem() . ' ' . trans('systems.to') . ' ' . $users->lastItem() . ' ( ' . trans('systems.total') . ' ' . $users ->total() . ' )' }}
                                </div>
                                <div class="col-md-9">
                                    {{ $users->appends(Request::except('page'))->links() }}
                                </div>
                            </div>
                        </div>

                        <?php $i = (($users->currentPage() - 1) * $users->perPage()) + 1;
                        $labels = ['success', 'info', 'danger', 'warning']; ?>
                        @if (count($users) > 0)
                            <table class='table table-striped table-bordered'>
                                <thead>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;">#</th>
                                    <th style="text-align: center; vertical-align: middle;"> {{ trans('users.user.name') }} </th>
                                    {{--<th style="text-align: center; vertical-align: middle;"> {{ trans('users.user.email') }} </th>--}}
                                    {{--<th style="text-align: center; vertical-align: middle;"> {{ trans('users.user.groups') }} </th>--}}
                                    <th style="text-align: center; vertical-align: middle;"> {{ trans('users.user.created_at') }} </th>
                                    <th style="text-align: center; vertical-align: middle;"> {{ trans('systems.action.name') }} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $item)
                                    <?php
                                    $group = Sentinel::findById($item->id)->getRoles()->first();
                                    ?>
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;">{{ $i++ }}</td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            <a href="{!! route('admin.user.show',$item->id) !!}">{!! $item->first_name.' '.$item->last_name!!}</a>
                                        </td>
                                        {{--<td style="text-align: center; vertical-align: middle;">
                                            {!! $item->email !!}
                                        </td>--}}
                                        {{--<td style="text-align: center; vertical-align: middle;">
                                            @if(isset($group->id))
                                                <label class="label label-{!! $labels[ $group->id % 4 ] !!}">{!! $group->name !!}</label>
                                            @endif
                                        </td>--}}
                                        <td style="text-align: center; vertical-align: middle;">
                                            {!! date("d-m-Y H:i:s", strtotime( $item->created_at )) !!}
                                        </td>
                                        <td>
                                            <a href="{!! route('admin.user.edit',$item->id) !!}" class="btn btn-default btn-xs"
                                               data-toggle="tooltip" data-placement="bottom" title="edit"><i
                                                        class="glyphicon glyphicon-edit"></i></a>
                                            <a href="{!! route('admin.user.destroy',$item->id) !!}"
                                               class="btn-confirm btn btn-danger btn-xs" id="{!! $item->id !!}"><i
                                                        class="glyphicon glyphicon-trash"></i></a>
                                            <a href="{!! route('admin.user.change_password', $item->id) !!}" class="btn btn-default btn-xs"
                                               data-toggle="tooltip" data-placement="bottom" title="Change Password"><i
                                                        class="glyphicon glyphicon-lock"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info"> {{ trans('systems.no_record_found') }}</div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('child-scripts')
    <script type="text/javascript">
        !function () {
            $(function () {
                $('.delete-record').click(function (e) {
                    e.preventDefault();
                    $('#comfirm').modal('hide');
                    $.ajax({
                        url: "{{ url('admin/permissions/user/delete/') }}" + '/' + $(this).attr('id'),
                        type: 'DELETE',
                        datatype: 'json',
                        headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
                        success: function (data) {
                            if (data.error) {
                                alert(data.message);
                            } else {
                                location.reload();
                            }
                        },
                        error: function (obj, status, err) {
                            alert("{{ trans('systems.have_an_error') }}");
                        }
                    }).always(function () {
                        if (box1) box1.remove();
                    });
                });
            });
        }(window.jquery);
    </script>
@endsection