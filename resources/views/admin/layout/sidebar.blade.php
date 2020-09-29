<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            
            @if(Auth::user()->hasPermissionTo('admin.page.index'))
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/pages') }}"><i class="nav-icon icon-book-open"></i> {{ trans('admin.page.title') }}</a></li>
            @endif

            @if(Auth::user()->hasPermissionTo('admin.user.index'))
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/users') }}"><i class="nav-icon icon-compass"></i> {{ trans('admin.user.title') }}</a></li>
            @endif

            {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            
            @if(Auth::user()->hasPermissionTo('admin.admin-user.index'))
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage access') }}</a></li>
            @endif
            
            @if(Auth::user()->hasPermissionTo('admin.translation.index'))
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}</a></li>
            @endif
            
            @if(Auth::user()->hasPermissionTo('admin.role.index'))
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/roles') }}"><i class="nav-icon icon-ghost"></i> {{ trans('admin.role.title') }}</a></li>
            @endif

            @if(Auth::user()->hasPermissionTo('admin.permission.index'))
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/permissions') }}"><i class="nav-icon icon-drop"></i> {{ trans('admin.permission.title') }}</a></li>
            @endif

            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>

