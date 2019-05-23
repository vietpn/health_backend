@extends('layouts.app')

@section('header')
    <section class="content-header">
        <h1>
            @yield('breadcrumb_title') <span class="text-lowercase">{{ '' }}</span>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ '' }}" class="text-capitalize">{{ '' }}</a></li>
            <li class="active">{{ '' }}</li>
        </ol>

    </section>
@endsection

@section('content')
    <section class="content-header">
        <h1>
            {!! trans("message.message") !!}
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-home"></i>{!! trans('app.view') !!} list chat messages of 2 users<??></h3>
            </div>
            <?php
                $isSender = true;
                $sender = \App\User::findOrFail($profile_sent);
                $senderAvatar = isset($sender->avatar_path) ? $sender->avatar_path : 'http://infyom.com/images/logo/blue_logo_150x150.jpg';

                $receive = \App\User::findOrFail($profile_recive);
                $receiveAvatar = isset($receive->avatar_path) ? $receive->avatar_path : 'http://infyom.com/images/logo/blue_logo_150x150.jpg';
            ?>

            <div class="box-body">
                <div class="box-body">
                    <div class="col-md-12">
                        <div class='row'>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username" class="col-sm-3 control-label label-text-right">{!! trans("message.sender") !!}:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-full">
                                            {!! $sender->email !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username" class="col-sm-3 control-label label-text-right">{!! trans("app.created_at") !!}:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-full">
                                            {!! $sender->created_at !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label label-text-right">{!! trans("message.receiver") !!}:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-full">
                                            {!! $receive->email !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username" class="col-sm-3 control-label label-text-right">{!! trans("app.created_at") !!}:</label>
                                    <div class="col-sm-9">
                                        <div class="input-group input-group-full">
                                            {!! $receive->created_at !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages" style="height: 600px; overflow: scroll;">
                    <?php
                        foreach ($message as $value){
                            if ($profile_sent == $value['profile_sent']){
                            ?>
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-left">{!! $sender->email !!}</span>
                                        <span class="direct-chat-timestamp pull-right">{!! $value['created_at'] !!}</span>
                                    </div>
                                    {{--<img class="direct-chat-img" src="http://infyom.com/images/logo/blue_logo_150x150.jpg" alt="Message User Image"><!-- /.direct-chat-img -->--}}
                                    <?php echo Html::image($senderAvatar , '',['style' => 'width:50px; height:50px', 'class'=>'direct-chat-img']) ?>
                                    <div class="direct-chat-text">
                                        {!! $value['messages'] !!}
                                        {!! isset($value['image']) ? '<br/><img class="direct-chat-img" src="'.$value['image'].'">': null !!}
                                    </div>
                                    <div class="pull-right">
                                        <a href="" onclick="return deleteMessage({!! $value['id'] !!})" class="btn-warning">{!! trans("app.delete") !!}</a>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <!-- Message to the right -->
                                <div class="direct-chat-msg right">
                                    <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right">{!! $receive->email !!}</span>
                                        <span class="direct-chat-timestamp pull-left">{!! $value['created_at'] !!}</span>
                                    </div>
                                    <!-- /.direct-chat-info -->
                                    {{--<img class="direct-chat-img" src="http://infyom.com/images/logo/blue_logo_150x150.jpg" style="width:50px; height:50px"><!-- /.direct-chat-img -->--}}
                                    <?php echo Html::image($receiveAvatar , '',['style' => 'width:50px; height:50px', 'class'=>'direct-chat-img']) ?>
                                    <div class="direct-chat-text">
                                        {!! $value['messages'] !!}
                                        {!! isset($value['image']) ? '<br/><img class="direct-chat-img" src="'.$value['image'].'">': null !!}
                                    </div>
                                    <div class="pull-left">
                                        <a href="" onclick="return deleteMessage({!! $value['id'] !!})" class="btn-warning">{!! trans("app.delete") !!}</a>
                                    </div>
                                </div>
                        <?php
                            }

                        }
                    ?>
                    </div>
                    <!-- End Conversations are loaded here -->

                </div>
            </div>

        </div>
    </div>
@endsection
@section('child-scripts')
    <script type="text/javascript">
        function deleteMessage(id) {
            var r = confirm("Are you sure to delete this message!");
            if (r == true) {
                $.ajax({
                    url: '{{ url('admin/messages/delete') }}/' + id,
                    type: 'DELETE',
                    datatype: 'json',
                    headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
                    success: function (data) {
                        if (data.error) {
                            location.reload();
                        } else {
                            location.reload();
                        }
                    }
                })
            }
        }
    </script>
@endsection