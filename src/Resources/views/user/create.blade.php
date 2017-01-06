@extends('cms::layouts.default-header', ['userPage' => true,])

@section('title')
@lang('cms::user.create.title')
@stop

@section('content')
<div class="l-wrapper">
    <div class="header header--page">
        <h3 class="hN">@lang('cms::user.create.header')</h3>
    </div>

    @if (isset($errors))
        @include('cms::includes.alert', [ 'errors' => $errors ])
    @endif

    {!! CMSForm::open([ 'url' => route('cms.user.save'), 'id' => 'form-user' ]) !!}
        <div class="l-section">
            <div class="l-content">
                {!! CMSForm::wrapLabel('name', trans('cms::user.fields.name.label')) !!}
                {!! CMSForm::text('name', null, [ 'placeholder' => trans('cms::user.fields.name.placeholder'), 'maxlength' => '100', 'autofocus' => 'autofocus' ]) !!}

                {!! CMSForm::wrapLabel('email', trans('user.fields.email.label')) !!}
                {!! CMSForm::input('email', 'email', null, [ 'placeholder' => trans('cms::user.fields.email.placeholder'), 'maxlength' => '100', 'autofocus' => 'autofocus' ]) !!}

                <div class="toggle-password js-toggle-password">
                    {!! CMSForm::wrapLabel('password', trans('cms::user.fields.password.create_label')) !!}
                    {!! CMSForm::input('password', 'password', null, [ 'maxlength' => '100' ]) !!}
                    <button class="toggle js-toggle">@lang('cms::user.controls.password_show')</button>
                </div>

                <label class="label" for="select-role">
                    @lang('cms::user.fields.cms_role.label')
                    <select id="select-role" name="cms_role" class="input input--select">
                        @foreach($roles AS $id => $role)
                        <option value="{{ $id }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>
        <div class="btn-group">
            <a href="{{ route('cms.user.index') }}" class="btn btn--transparent" role="button">@lang('cms::user.controls.cancel')</a>
            <button class="btn btn--green" type="submit">@lang('cms::user.controls.create')</button>
        </div>
    {!! CMSForm::close() !!}
</div>
@stop
