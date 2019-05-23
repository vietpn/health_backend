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
                            {{ Html::link(URL::route('admin.roles.create'), trans('systems.create'), array('class' => 'btn btn-primary')) }}
                        </p>

                        <div class="text-right">
                            <div class="row">
                                <div class="col-md-3 text-left">
                                    {{ $group->firstItem() . ' ' . trans('systems.to') . ' ' . $group->lastItem() . ' ( ' . trans('systems.total') . ' ' . $group ->total() . ' )' }}
                                </div>
                                <div class="col-md-9">
                                    {{ $group->appends(Request::except('page'))->links() }}
                                </div>
                            </div>

                        </div>

                        <table class="table table-striped table-bordered table-hover" id='init-table'>
                            <thead>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;width: 3%">ID</th>
                                <th style="text-align: center; vertical-align: middle;">{!! trans('users.name') !!}</th>
                                <th style="text-align: center; vertical-align: middle;">{{trans('users.role.person_number')}}</th>
                                <th style="width:17%">{{trans('systems.action.name')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($group)
                                @foreach($group as $item)
                                    <tr>
                                        <td style="text-align: center; vertical-align: middle;">{!! $item->id !!}</td>
                                        <td style="text-align: center; vertical-align: middle;">{!! $item->name !!}</td>
                                        <td style="text-align: center; vertical-align: middle;">{!!$item->user()->count() !!}</td>
                                        <td style="text-align: center; vertical-align: middle;">
                                            @if($item->id)
                                                <a href="{!! route('admin.roles.show',$item->id) !!}" class="btn btn-default btn-xs"data-toggle="tooltip" data-placement="bottom" title="show"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                <a href="{!! route('admin.roles.edit',$item->id) !!}" class="btn btn-default btn-xs"data-toggle="tooltip" data-placement="bottom" title="edit"><i class="glyphicon glyphicon-edit"></i></a>
                                                <a href="{!! route('admin.roles.destroy',$item->id) !!}"class="btn-confirm btn btn-danger btn-xs" id='{!! $item->id !!}'data-toggle="tooltip"data-placement="bottom" title="delete"><i class="glyphicon glyphicon-trash"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>

                        </table>
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
                        url: "{{ url('admin/permissions/roles/delete/') }}" + '/' + $(this).attr('id'),
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
                    });
                });
            });
        }(window.jquery);
    </script>
@endsection
