<header class="header header--primary" role="banner">
    <div class="header__brand" style="background: {{ config('cms.brand.color') }}">
        <a href="{{ route('cms.index') }}">{{ config('cms.brand.title') }}</a>
        <a class="header__btn js-nav-toggle" href="#" role="button"><span class="icon fa fa-plus" aria-hidden="true"></span>Menu</a>
    </div>
    <nav class="nav nav--horizontal js-nav" role="navigation">
        <ol class="list">
            @foreach (Wearenext\CMS\Models\PageType::all() as $t)
            <li{!! ((isset($type) && $type->id == $t->id)?' class="is-active"':'') !!}><a href="{{ $t->pageUrl() }}">{{ $t->label }}</a></li>
            @endforeach
            @can('cms.user_index')
                <li{!! (isset($userPage)?' class="is-active"':'') !!}><a href="{{ route('cms.user.index') }}">Users</a></li>
            @endcan
        </ol>
        <ol class="list list--utils">
            @can('cms.user_edit')
                <li><a href="{{ route('cms.user.edit', ['user' => auth()->user(),]) }}">{{ auth()->user()->name }}</a></li>
            @else
                <li><a href="#">{{ auth()->user()->name }}</a></li>
            @endcan
            <li><a href="{{ route('cms.user.logout') }}"><span class="icon fa fa-sign-out" title="Sign Out" aria-hidden="true"></span></a></li>
        </ol>
    </nav>
</header>
