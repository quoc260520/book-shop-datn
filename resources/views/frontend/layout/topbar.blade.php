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
                    <a class="header__navbar-item-link" href="">
                        <i class="header__navbar-icon far fa-bell"></i>
                        Thông báo
                    </a>
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
                @if(!auth()->user())
                <a class="header__navbar-item header__navbar-item--strong header__navbar-item--separate btn__register"
                    href="{{ route('login') }}">
                    Đăng ký</a>
                <a class="header__navbar-item header__navbar-item--strong btn__login"
                    href="{{ route('login') }}">
                    Đăng nhập
                </a>
                @else
                <li class="header__navbar-item header__navbar-user">
                    <img alt="" class="header__navbar-user-img" src="{{ asset('images/logo/account.jpg') }}">
                    <span class="header__navbar-user-name">{{ auth()->user()->first_name }}</span>

                    <ul class="header__navbar-user-menu">
                        <li class="header__navbar-user-item">
                            <a href="">Tài khoản của tôi</a>
                        </li>
                        <li class="header__navbar-user-item">
                            <a href="">Đơn mua</a>
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
            <div class="header__search">
                <div class="header__search-input-wrap">
                    <input class="header__search-input" placeholder="Tìm trong shop này" type="text">
                    <div class="header__search-input-history header__search-input-history-js">
                        <h3 class="header__search-input-history-heading">Lịch sử tìm kiếm</h3>
                        <ul class="header__search-input-history-list">
                            <li class="header__search-input-history-item">
                                <a href="">Pubg</a>

                            </li>
                            <li class="header__search-input-history-item">
                                <a href="">Csgo</a>

                            </li>
                        </ul>

                    </div>
                </div>
                <div class="header__search-select">
                    <span class="header__search-select-lable">Trong shop</span>
                    <i class="header__search-select-icon fas fa-angle-down"></i>

                    <ul class="header__search-option">
                        <li class="header__search-option-item header__search-option-item--active">
                            <span>Trong shop</span>
                            <i class="fas fa-check"></i>
                        </li>
                        <li class="header__search-option-item ">
                            <span>Ngoài shop</span>
                            <i class="fas fa-check"></i>
                        </li>
                    </ul>
                </div>
                <button class="header__search-btn">
                    <i class="header__search-btn-icon fas fa-search"></i>
                </button>
            </div>
            <!-- Cart layout -->
            <div class="header__cart">
                <div class="header__cart-wrap">
                    <i class="header__cart-icon fas fa-shopping-cart"></i>
                    <span class="header__cart-notice">3</span>
                    <!-- No-cart :header__cart-list--no-cart -->
                    <div class="header__cart-list">
                        @if ($cart ?? false)
                            <h4 class="header__cart-heading">Sản Phẩm Đã Thêm</h4>
                            <ul class="header__cart-list-item">
                                <li class="header__cart-item">
                                    <img alt="" class="header__cart-img" src="./assets/img/item.jfif">
                                    <div class="header__cart-item-info">
                                        <div class="header__cart-item-head">
                                            <h5 class="header__cart-item-name">Áo sơ mi tay </h5>
                                            <div class="header__cart-item-price-wrap">
                                                <span class="header__cart-item-price">2.000.000đ</span>
                                                <span class="header__cart-item-multiply">x</span>
                                                <span class="header__cart-item-quantity">2</span>
                                            </div>
                                        </div>
                                        <div class="header__cart-item-body">
                                            <span class="header__cart-item-description">
                                                Phân loại: Trắng
                                            </span>
                                            <span class="header__cart-item-remove">Xóa</span>

                                        </div>

                                    </div>
                                </li>

                                <li class="header__cart-item">
                                    <img alt="" class="header__cart-img" src="./assets/img/item.jfif">
                                    <div class="header__cart-item-info">
                                        <div class="header__cart-item-head">
                                            <h5 class="header__cart-item-name">Áo sơ mi tay </h5>
                                            <div class="header__cart-item-price-wrap">
                                                <span class="header__cart-item-price">2.000.000đ</span>
                                                <span class="header__cart-item-multiply">x</span>
                                                <span class="header__cart-item-quantity">2</span>
                                            </div>


                                        </div>
                                        <div class="header__cart-item-body">
                                            <span class="header__cart-item-description">
                                                Phân loại: Trắng
                                            </span>
                                            <span class="header__cart-item-remove">Xóa</span>

                                        </div>

                                    </div>
                                </li>

                                <li class="header__cart-item">
                                    <img alt="" class="header__cart-img" src="./assets/img/item.jfif">
                                    <div class="header__cart-item-info">
                                        <div class="header__cart-item-head">
                                            <h5 class="header__cart-item-name">Áo sơ mi tay </h5>
                                            <div class="header__cart-item-price-wrap">
                                                <span class="header__cart-item-price">2.000.000đ</span>
                                                <span class="header__cart-item-multiply">x</span>
                                                <span class="header__cart-item-quantity">2</span>
                                            </div>


                                        </div>
                                        <div class="header__cart-item-body">
                                            <span class="header__cart-item-description">
                                                Phân loại: Trắng
                                            </span>
                                            <span class="header__cart-item-remove">Xóa</span>

                                        </div>

                                    </div>
                                </li>

                            </ul>
                            <a class="btn btn--primary header__cart-view-cart" href="#">Xem giỏ hàng</a>
                        @else
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <img alt="" class="header__cart-no-cart-img"
                                    src="{{ asset('images/app/no_cart.png') }}">
                                <span class="header__cart-list-no-cart-msg">
                                    Chưa có sản phẩm
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
</header>
