<header class="header">
    <div class="grid">
        <nav class="header__navbar">
            <ul class="header__navbar-list">
                <li class="header__navbar-item header__navbar-item--separate header__navbar-item--has-qr">
                    Vào của hàng trên website Book-Shop
                </li>
                <li class="header__navbar-item">
                    <span class="header__navbar-title--no-pointer">Kết nối</span>
                    <a class="header__navbar--icon-link" href="">
                        <i class="header__navbar-icon fab fa-facebook"></i>
                    </a>
                    <a class="header__navbar--icon-link" href="">
                        <i class="header__navbar-icon fab fa-instagram"></i>
                    </a>
                </li>
            </ul>

            <ul class="header__navbar-list">
                <li class="header__navbar-item header__navbar-item--has-notify">
                    <div class="header__notify">
                        <header class="header__notify-header">
                            <h3>Thông báo mới nhận</h3>
                        </header>
                        <ul class="header__notify-list">
                            <li class="header__notify-item ">
                                <a class="header__notify-link" href="">
                                    <img alt="" class="header__notify-img" src="">
                                    <div class="header__notify-info">
                                        <span class="header__notify-name">Mỹ phẩm Ohui chính hãng</span>
                                        <span class="header__notify-descriotion">Mô tả mỹ phẩm chính hãng</span>
                                    </div>
                                </a>
                            </li>

                        </ul>
                        <footer class="header__notify-footer">
                            <a class="header__notify-footer-btn" href="">Xem tất cả</a>
                        </footer>
                    </div>
                </li>
                <li class="header__navbar-item">
                    <a class="header__navbar-item-link" href="">
                        <i class="header__navbar-icon far fa-question-circle"></i>
                        Trợ giúp
                    </a>
                </li>
                @if (!auth()->user())
                    <a class="header__navbar-item header__navbar-item--strong header__navbar-item--separate btn__register"
                        href="{{ route('login') }}">
                        Đăng ký</a>
                    <a class="header__navbar-item header__navbar-item--strong btn__login" href="{{ route('login') }}">
                        Đăng nhập
                    </a>
                @else
                    <li class="header__navbar-item header__navbar-user">
                        <img alt="" class="header__navbar-user-img" src="{{ get_avatar() }}">
                        <span
                            class="header__navbar-user-name">{{ auth()->user()->first_name . ' ' . auth()->user()->last_name }}</span>

                        <ul class="header__navbar-user-menu">
                            @if (auth()->user())
                                <li class="header__navbar-user-item">
                                    <a href="{{ route('account.info', ['id' => auth()->user()->id]) }}">Tài khoản của
                                        tôi</a>
                                </li>
                            @endif
                            <li class="header__navbar-user-item">
                                <a href="{{ route('order.list') }}">Đơn mua</a>
                            </li>
                            <li class="header__navbar-user-item header__navbar-user-item--separate">
                                <a href="{{ route('logout') }}">Đăng xuất</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- Header with search -->
        <div class="header-with-search">
            <div class="header__logo">
                <a class="header__logo-link" href="/">
                    {!! file_get_contents(public_path('images/logo/logo_index.svg')) !!}
                </a>
            </div>
            <form action="{{ route('search') }}" class="header__search" method="get">
                <div class="header__search">
                    <div class="header__search-input-wrap">
                        <input autocomplete="off" class="header__search-input" name="book_name"
                            placeholder="Tìm sản phẩm bạn mong muốn..." type="text">
                        <div class="header__search-input-history header__search-input-history-js">
                            <h3 class="header__search-input-history-heading">Lịch sử tìm kiếm</h3>
                            <ul class="header__search-input-history-list" id="list-history">
                            </ul>

                        </div>
                    </div>
                    <button class="header__search-btn" id="btn-search" type="submit">
                        <i class="header__search-btn-icon fas fa-search"></i>
                    </button>
                </div>
            </form>
            <!-- Cart layout -->
            <div class="header__cart">
                <a href="{{ route('cart') }}"class="header__cart-wrap">
                    <i class="header__cart-icon fas fa-shopping-cart"></i>
                    <span class="header__cart-notice">{{ get_count_cart() }}</span>
                </a>
            </div>

        </div>
    </div>
</header>
