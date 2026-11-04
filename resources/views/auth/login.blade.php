@extends('layouts.auth')

@section('title', __('login'))

@section('form')
    <form action="{{ route('login') }}" method="post" name="login" id="login">
        @csrf
        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <input type="text" name="username" value="{{ old('username') }}" class="form-control has-feedback-left" placeholder="{{ __('username') }}" autocomplete="off">
            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <input type="password" name="password" class="form-control has-feedback-left" placeholder="{{ __('password') }}" autocomplete="off">
            <span class="fa fa-asterisk form-control-feedback left" aria-hidden="true"></span>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12_">
            <input class="btn btn-primary login-button" type="submit" name="submit" value="{{ __('login') }}" />
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12_">
            <a class="reset_pass btn btn-primary login-button" href="{{ route('password.request') }}">{{ __('lost_your_password') }}</a>
        </div>
        <div class="clearfix"></div>
    </form>
@endsection
