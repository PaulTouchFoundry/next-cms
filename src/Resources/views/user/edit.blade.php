@extends('cms::layouts.default-header', ['userPage' => true,])

@section('title')
@lang('cms::user.edit.title')
@stop

@section('content')
<div class="l-wrapper">
    <div class="header header--page">
        <h3 class="hN">@lang('cms::user.edit.header', [ 'user' => $user->name ])</b></h3>
    </div>
    
    @include('cms::includes.alert', [ 'errors' => $errors ])

    {!! CMSForm::open([ 'url' => route('cms.user.update', [ $user ]), 'id' => 'form-user', 'method' => 'post', 'id' => 'form-details' ]) !!}
        <div class="l-section">
            <div class="l-content">
                {!! CMSForm::wrapLabel('name', trans('cms::user.fields.name.label')) !!}
                {!! CMSForm::text('name', $user->name, [ 'placeholder' => trans('cms::user.fields.name.placeholder'), 'maxlength' => '100', 'autofocus' => 'autofocus' ]) !!}

                {!! CMSForm::wrapLabel('email', trans('cms::user.fields.email.label')) !!}
                {!! CMSForm::input('email', 'email', $user->email, [ 'placeholder' => trans('cms::user.fields.email.placeholder'), 'maxlength' => '100', 'autofocus' => 'autofocus' ]) !!}

                <div class="toggle-password js-toggle-password">
                    <label class="label" for="password">
                        @lang('cms::user.fields.password.change_label')
                        <input class="input" type="password" id="password" name="password" maxlength="100" value="" />
                        <span class="help-text">@lang('cms::user.fields.password.unchanged')</span>
                    </label>
                    <button class="toggle js-toggle">@lang('cms::user.controls.password_show')</button>
                </div>

                <label class="label" for="select-role">
                    @lang('cms::user.fields.cms_role.label')
                    <select id="select-role" name="cms_role" class="input input--select">
                        @foreach($roles AS $id => $role)
                        <option value="{{ $id }}" {{ ($user->cms_role == $id ? 'selected' : '') }} >{{ $role }}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>
        <div class="btn-group">
            <a href="{{ route('cms.user.index') }}" class="btn btn--transparent" role="button">@lang('cms::user.controls.cancel')</a>
            <button class="btn" type="submit">@lang('cms::user.controls.update')</button>
        </div>
    {!! CMSForm::close() !!}

    @can('cms.user_delete')
    @if (auth()->user()->id != $user->id)
        <hr class="hr" />
        {!! CMSForm::open([ 'url' => route('cms.user.delete', [ $user ]), 'method' => 'post', 'id' => 'delete-user-form' ]) !!}
        <button type="submit" class="btn btn--icon btn--red" role="button" id="delete-user"><span class="icon icon--left fa fa-trash-o" aria-hidden="true"></span>@lang('cms::user.controls.delete')</button>
        {!! CMSForm::close() !!}
        <hr class="hr" />
    @endif
    @endcan
</div>
@stop
