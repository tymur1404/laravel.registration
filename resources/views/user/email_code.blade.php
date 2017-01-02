@extends('app')

@section('content')
    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">Please enter the code that has come to you on email</div>
                </div>
                <div style="padding-top:30px" class="panel-body" >
                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                    {!! Form::open(['route' => 'login.index']) !!}
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        {!! Form::text('email_code', null , ['class' => 'form-control', 'id' =>'login-password', 'placeholder'=>'email code' ]) !!}
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            {!! Form::button('Submit', ['class' => "btn btn-success", 'id' =>"submit" ]) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>

@stop