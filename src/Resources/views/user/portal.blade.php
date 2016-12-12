@extends('cms::layouts.default')

@section('title')
@lang('cms::user.login.title')
@stop

@section('content')
<div class="l-wrapper l-wrapper--narrow">
    @include('cms::includes.alert', [ 'errors' => $errors ])
    <div class="header header--primary">
        <div class="header__brand" style="background:{{ config('cms.brand.color') }}">
            {{ config('cms.brand.title') }}
        </div>
    </div>
    <div class="l-section">
        <div class="l-content">
            {!! CMSForm::open([ 'url' => route('cms.user.login'), 'id' => 'form-sign-in']) !!}
            {!! CMSForm::wrapLabel('email', trans('cms::user.fields.email.label')) !!} 
            {!! CMSForm::email('email', null, [ 'placeholder' => trans('cms::user.fields.email.placeholder') ]) !!}

            <div class="toggle-password js-toggle-password">
                {!! CMSForm::wrapLabel('password', trans('cms::user.fields.password.label')) !!}
                {!! CMSForm::password('password') !!}
                {!! CMSForm::button(trans('cms::user.controls.password_show'), [ 'class' => 'toggle js-toggle']) !!}
            </div>

            {!! CMSForm::submit(trans('cms::user.controls.sign_in')) !!}
            {!! CMSForm::close() !!}
        </div>
    </div>
</div>
@stop
