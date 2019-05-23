@extends('layouts.app')

@section('content')
    <section class="content-header">

    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-home"></i>{!! trans('app.view') !!} #<?=$model->id?></h3>
            </div>
            <div class="box-body">
                <div class="row" style="padding-left: 20px; padding-right: 20px">
                    <table class="table table-striped table-bordered table-hover">
                        @include('backend.permissions.user.show_fields')
                    </table>
                    <a href="{!! route('admin.user.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
