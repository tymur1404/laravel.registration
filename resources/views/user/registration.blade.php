@extends('app')

@section('content')
    <div class="container">
        {!! link_to_route('login.index', 'Login') !!}
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">Registration</div>
                </div>
                <div style="padding-top:30px" class="panel-body" >
                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        {!! Form::open(['route' => 'login.index']) !!}
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            {!! Form::text('email', null , ['class' => 'form-control', 'id' =>'login-username', 'placeholder'=>'username or email' ]) !!}
                        </div>

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            {!! Form::text('password', null , ['class' => 'form-control', 'id' =>'login-password', 'placeholder'=>'password' ]) !!}
                        </div>
                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->
                            <div class="col-sm-12 controls">
                                {!! Form::button('Sign Up', ['class' => "btn btn-success", 'id' =>"btn-registration" ]) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
@stop


