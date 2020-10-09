<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <ul class="app-menu">
        <li>
            <a class="app-menu__item  {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="app-menu__icon fa fa-dashboard"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Master</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item {{ sidebar_open(['admin.categories.*']) }}"
                    href="{{ route('admin.categories.index') }}">
                    <i class="icon fa fa-circle-o"></i>All Categories
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{ sidebar_open(['admin.genres.*']) }}"
                    href="{{ route('admin.genres.index') }}">
                    <i class="icon fa fa-circle-o"></i>All Genres
                    </a>
                </li>
                <li>
                    <a class="treeview-item {{ sidebar_open(['admin.language.*']) }}"
                    href="{{ route('admin.language.index') }}">
                    <i class="icon fa fa-circle-o"></i>All Languages
                    </a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Banner</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item {{ sidebar_open(['admin.banner.*']) }}"
                    href="{{ route('admin.banner.index') }}">
                    <i class="icon fa fa-circle-o"></i>All Banners
                    </a>
                </li>
            </ul>
        </li>
        {{-- <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Genre</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item {{ sidebar_open(['admin.genres.*']) }}"
                    href="{{ route('admin.genres.index') }}">
                    <i class="icon fa fa-circle-o"></i>All Genres
                    </a>
                </li>
            </ul>
        </li> --}}
        {{-- <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Language</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item {{ sidebar_open(['admin.language.*']) }}"
                    href="{{ route('admin.language.index') }}">
                    <i class="icon fa fa-circle-o"></i>All Languages
                    </a>
                </li>
            </ul>
        </li> --}}
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Show</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="app-menu__item {{ sidebar_open(['admin.show.index']) }}"
                    href="{{ route('admin.show.index') }}">
                    <i class="icon fa fa-circle-o"></i>All Shows
                    </a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Webseries</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="app-menu__item {{ sidebar_open(['admin.webseries.index']) }}"
                    href="{{ route('admin.webseries.index') }}">
                    <i class="icon fa fa-circle-o"></i>All Webseries
                    </a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Episode</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="app-menu__item {{ sidebar_open(['admin.episode.index']) }}"
                    href="{{ route('admin.episode.index') }}">
                    <i class="icon fa fa-circle-o"></i>All Episode
                    </a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Trailer</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="app-menu__item {{ sidebar_open(['admin.trailer.index']) }}"
                    href="{{ route('admin.trailer.index') }}">
                    <i class="icon fa fa-circle-o"></i>All Trailer
                    </a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">User</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="app-menu__item {{ sidebar_open(['admin.users.index']) }}"
                    href="{{ route('admin.users.index') }}">
                    <i class="icon fa fa-circle-o"></i>All User
                    </a>
                </li>
            </ul>
        </li>
        <li class="treeview">
            <a class="app-menu__item" href="#" data-toggle="treeview">
                <i class="app-menu__icon fa fa-group"></i>
                <span class="app-menu__label">Package</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="app-menu__item {{ sidebar_open(['admin.packages.index']) }}"
                    href="{{ route('admin.packages.index') }}">
                    <i class="icon fa fa-circle-o"></i>All Package
                    </a>
                </li>
            </ul>
        </li>
        
       <li>
            <a class="app-menu__item {{ sidebar_open(['admin.settings']) }}"
                href="{{ route('admin.settings') }}"><i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">Settings</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ sidebar_open(['admin.packages.getSubscriptions']) }}"
                href="{{ route('admin.packages.getSubscriptions') }}"><i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">All Subscriptions</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ sidebar_open(['admin.show.getPayPerClickSubscriptions']) }}"
                href="{{ route('admin.show.getPayPerClickSubscriptions') }}"><i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">PPC Subscriptions</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ sidebar_open(['admin.show.getTransactionsData']) }}"
                href="{{ route('admin.show.getTransactionsData') }}"><i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">All Transactions</span>
            </a>
        </li>
    </ul>
</aside>