<!-- Username Field -->
<div class="form-group">
    {!! Form::label('username', 'Username:') !!}
    {!! Form::text('username', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Number Field -->
<div class="form-group">
    {!! Form::label('phone_number', 'Phone Number:') !!}
    {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Birthday Field -->
<div class="form-group">
    {!! Form::label('birthday', 'Birthday:') !!}
    <div class="input-group">
        <?php
        if ( isset($profile) && !empty($profile->birthday)) {
            echo Form::text('birthday', Request::old('birthday', $profile->birthday),['class'=>'form-control', 'id'=>'birthday']);
        }else {
            echo Form::text('birthday', Request::old('birthday', ''),['class'=>'form-control', 'id'=>'birthday']);
        }
        ?>
        <label class="input-group-addon btn" for="date">
            <span class="fa fa-calendar open-datetimepicker"></span>
        </label>
    </div>
</div>

<!-- Password Field -->
<div class="form-group">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control', 'value' => '', 'autocomplete' => 'new-password']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('backend.profiles.index') !!}" class="btn btn-default">Cancel</a>
</div>


<!--datepicker-->
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<!--end datepicker-->
<script type="text/javascript">
    $('#birthday').datepicker({
        dateFormat: 'yy-mm-dd',
    });
</script>