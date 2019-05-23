<!-- Name Field -->
@php
    $name = ['A','B','C','D'];
    $i=0;
@endphp
@foreach($model as $key => $item)
    <div class="row">
        <div class="col-md-2">
            <div class="form-group ">
                {!! Form::text('name[]', Request::old('name[]',$item->name),
                 [
                 'class' => 'form-control',
                 'placeholder'   =>  __('rank_config.name'),
                 'id'   =>  'name_'.($i+1)
                 ]) !!}
            </div>
        </div>
        <div class="col-md-4">
            @php
                $end = ($i==0)?'không giới hạn':"";
            @endphp

            {!! Form::text('begin[]', Request::old('begin[]',$item->begin), ['class' => 'form-control salary begin','placeholder'   =>  __('rank_config.begin'),'id'   =>  'begin_'.($i+1)]) !!}
            <div class="error_begin_{!! $i+1 !!} error"></div>
        </div>
        <div class="col-md-1 text-center">
            <i class="fa fa-arrows-h" aria-hidden="true"></i>
        </div>
        <div class="col-md-4">
            @if($i ===0)
                {!! Form::text('end[]', Request::old('end[]',$item->end), [
            'class' => 'form-control end',
            'placeholder'   =>  __('rank_config.end'),
            'id'   =>  'end_'.($i+1),
            'readonly'=>($i==0)?true:false
            ]) !!}
            @else
                {!! Form::text('end[]', Request::old('end[]',$item->end), [
            'class' => 'form-control salary end',
            'placeholder'   =>  __('rank_config.end'),
            'id'   =>  'end_'.($i+1)
            ]) !!}
            @endif
            <div class="error_end_{!! $i+1 !!} error"></div>
        </div>
    </div>
    @php
        $i++;
    @endphp
@endforeach
<div class="row">
    <div class="col-md-2 text-right">
        {!! Form::label('time',__('rank_config.time')) !!} :
    </div>
    <div class="col-md-4">
        {!! Form::select('time',\App\Define\Systems::getSetTime(),Request::old('time'),['class' => 'form-control']) !!}
    </div>
</div>

<!-- Begin Field -->
<!-- Submit Field -->
<div class="form-group col-sm-12 text-center" style="margin-top: 20px">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.rankConfigs.index') !!}" class="btn btn-default">Cancel</a>
</div>
@section('scripts')
    {!! Html::script('assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js') !!}
    <script type="text/javascript">
        function input_mask_currency_class(id, currency) {
            $("." + id).inputmask("remove");
            $('.' + id).inputmask("decimal", {
                autoUnmask: true,
                autoGroup: true,
                groupSeparator: ",",
                groupSize: 3,
                removeMaskOnSubmit: true,
                digits: 2,
                allowMinus: false,
                allowPlus: false,
                suffix: " " + currency
            });
        }
        !function ($) {
            $(function () {
                input_mask_currency_class("salary", "");
                $('.begin').keyup(function () {
                    var id = $(this).attr('id');
                    var Sid = id.split('begin_');
                    var key = Sid[1];
                    if (parseInt(key) > 1 && parseInt(key) < 4) {
                        if (
                                parseInt($(this).val()) > parseInt($('#begin_' + (parseInt(key) - 1)).val())
                                || parseInt($(this).val()) > parseInt($('#end_' + key).val())
                        ) {
                            $('.error_begin_' + key).html("").append("Khoản point đang lớn hơn");
                            $('.btn-primary').addClass('disabled').attr('type','button');
                            return false;
                        } else if (parseInt($(this).val()) < parseInt($('#begin_' + (parseInt(key) + 1)).val())) {
                            $('.error_begin_' + key).html("").append("Khoản point đang nhỏ hơn");
                            $('.btn-primary').addClass('disabled').attr('type','button');
                            return false;
                        } else {
                            $('.error_begin_' + key).html("");
                            $('.btn-primary').removeClass('disabled').attr('type','submit');
                            return true;
                        }
                    } else if (parseInt(key) == 1) {
                        if (parseInt($(this).val()) < parseInt($('#begin_' + (parseInt(key) + 1)).val())) {
                            $('.error_begin_' + key).html("").append("Khoản point đang nhỏ hơn");
                            $('.btn-primary').addClass('disabled').attr('type','button');
                            return false;
                        } else {
                            $('.error_begin_' + key).html("");
                            $('.btn-primary').removeClass('disabled').attr('type','submit');
                            return true;
                        }
                    } else if (parseInt(key) == 4) {
                        if (
                                parseInt($(this).val()) > parseInt($('#begin_' + (parseInt(key) - 1)).val())
                                || parseInt($(this).val()) > parseInt($('#end_' + key).val())
                        ) {
                            $('.error_begin_' + key).html("").append("Khoản point đang lớn hơn");
                            $('.btn-primary').addClass('disabled').attr('type','button');
                            return false;
                        } else {
                            $('.error_begin_' + key).html("");
                            $('.btn-primary').removeClass('disabled').attr('type','submit');
                            return true;
                        }
                    }
                });
                $('.end').keyup(function () {
                    var id = $(this).attr('id');
                    var Sid = id.split('end_');
                    var key = Sid[1];
                    if (parseInt(key) > 1 && parseInt(key) < 4) {
                        if (
                                parseInt($(this).val()) < parseInt($('#end_' + (parseInt(key) + 1)).val())
                                || parseInt($(this).val()) < parseInt($('#begin_' + key).val())
                        ) {
                            $('.error_end_' + key).html("").append("Khoản point đang nhỏ hơn");
                            $('.btn-primary').addClass('disabled').attr('type','button');
                            return false;
                        } else if (parseInt($(this).val()) > parseInt($('#begin_' + (parseInt(key) - 1)).val())) {
                            $('.error_end_' + key).html("").append("Khoản point đang lớn hơn");
                            $('.btn-primary').addClass('disabled').attr('type','button');
                            return false;
                        } else {
                            $('.error_end_' + key).html("");
                            $('.btn-primary').removeClass('disabled').attr('type','submit');
                            return true;
                        }
                    } else if (parseInt(key) == 4) {
                        if (
                                parseInt($(this).val()) > parseInt($('#begin_' + (parseInt(key) - 1)).val())
                                || parseInt($(this).val()) < parseInt($('#begin_' + key).val())
                        ) {
                            $('.error_end_' + key).html("").append("Khoản point đang lớn hơn");
                            $('.btn-primary').addClass('disabled').attr('type','button');
                            return false;
                        } else {
                            $('.error_end_' + key).html("");
                            $('.btn-primary').removeClass('disabled').attr('type','submit');
                            return true;
                        }
                    }
                });
            });
        }(window.jQuery);
    </script>
@endsection