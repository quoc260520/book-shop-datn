<aside class="main-sidebar sidebar-admin sidebar-dark-primary elevation-4 position-fixed">
    <a class="brand-link d-flex flex-row justify-content-center" href="#">
        <div class="logo">
            {!! file_get_contents(public_path('images/logo/logo.svg')) !!}
        </div>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-accordion="false" data-widget="treeview" role="menu">
                <li class="nav-item has-treeview menu-open">
                    <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link {{ Route::is('admin.account.*') ? 'active' : '' }}"
                        href="{{ route('admin.account.list') }}">
                        <i class="nav-icon fa-solid fa-users"></i>
                        <p>
                            Quản lý tài khoản
                            <span class="badge badge-info right">6</span>
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link {{ Route::is('admin.book.*') ? 'active' : '' }}" href="#">
                        <i class="nav-icon fa-solid fa-book"></i>
                        <p>
                            Quản lý sách
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.book.list') }}">
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link" {{ Route::is('admin.slider.list') ? 'active' : '' }}
                    href="{{ route('admin.slider.list') }}">
                        <i class="nav-icon fa-solid fa-sliders"></i>
                        <p>
                            Quản lý slide
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link {{ Route::is('admin.author.*') ? 'active' : '' }}" href="#">
                        <i class="nav-icon fa-solid fa-user-pen"></i>
                        <p>
                            Quản lý tác giả
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.author.list') }}">
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.author.create') }}">
                                <p>Thêm tác giả </p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link {{ Route::is('admin.publisher.*') ? 'active' : '' }}" href="#">
                        <i class="nav-icon fa-solid fa-shop"></i>
                        <p>
                            Quản lý nhà xuất bản
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.publisher.list') }}">
                                <p>Danh sách</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.publisher.create') }}">
                                <p>Thêm nhà xuất bản</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link {{ Route::is('admin.category.*') ? 'active' : '' }}" href="#">
                        <i class="nav-icon fa-solid fa-list"></i>
                        <p>
                            Quản lý danh mục
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.category.list') }}">
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link {{ Route::is('admin.voucher.*') ? 'active' : '' }}" href="#">
                        <i class="nav-icon fa-solid fa-percent"></i>
                        <p>
                            Quản lý mã giảm giá 
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.voucher.list') }}">
                                <p>Danh sách</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link {{ Route::is('admin.order.*') ? 'active' : '' }}" href="{{ route('admin.order.list') }}">
                        <i class="nav-icon fa-solid fa-truck-fast"></i>
                        <p>
                            Quản lý đơn hàng
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
