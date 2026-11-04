@extends('layouts.auth')

@section('title', __('reset_password'))

@section('form')
    <form action="{{ route('password.email') }}" method="post" name="login" id="login">
        @csrf
        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <input type="text" name="username" class="form-control has-feedback-left" placeholder="{{ __('username') }}" autocomplete="off">
            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input class="btn btn-primary login-button" type="submit" name="submit" value="{{ __('submit') }}" />
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <a class="reset_pass btn btn-primary login-button" href="{{ route('login') }}">{{ __('login') }}</a>
        </div>
        <div class="clearfix"></div>
    </form>
@endsection
