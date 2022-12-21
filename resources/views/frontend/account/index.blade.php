@extends('frontend.app')
@section('content')
    <div class="grid vh-100" style="margin-top:100px;">
        <div class="" style="margin-top:130px;">
            @include('partials.message')
        </div>
        <div class="grid__row app__content">
            <div class="grid__column-2">
                <nav class="category">
                    <h3 class="category__heading">Tài khoàn của tôi</h3>
                    <ul class="category-list">
                        <li class="category-item {{ Route::is('account.info',auth()->user()->id) ? 'category-item--active' : '' }}">
                            <a class="catrgory-item__link" href="{{ route('account.info',auth()->user()->id) }}">Thông tin</a>
                        </li>
                        <li class="category-item {{ Route::is('account.change-password',auth()->user()->id) ? 'category-item--active' : '' }}">
                            <a class="catrgory-item__link" href="{{ route('account.change-password',auth()->user()->id) }}">Đổi mật khẩu</a>
                        </li>
                        <li class="category-item {{ Route::is('order.list') ? 'category-item--active' : '' }}">
                            <a class="catrgory-item__link" href="{{ route('order.list') }}">Đơn hàng</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="grid__column-10 pe-0">
                @yield('info')
                @yield('change-password')
                @yield('order')
            </div>
        </div>
    </div>
@endsection

<style>
    .info-account {
        font-size: 14px;
    }

    .input-info {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.6;
        color: #212529;
        background-color: #f8fafc;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 0.375rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .avatar-info {
        width: 100px;
        height: 100px;
        border-radius: 50%;
    }

    .avatar-input {
        opacity: 0;
        width: 0.1px;
        height: 0.1px;
        position: absolute;
    }

    .file-input label {
        display: block;
        position: relative;
        width: 120px;
        height: 50px;
        border-radius: 4px;
        background: linear-gradient(40deg, #ff6ec4, #7873f5);
        box-shadow: 0 4px 7px rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: transform .2s ease-out;
    }
</style>
