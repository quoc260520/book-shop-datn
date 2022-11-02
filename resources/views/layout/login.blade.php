@extends('app')
@section('content')
    <div class="wrapper">
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <h1 class="m-0 fw-bold">Tạo tài khoản mới</h1>
                    <div class="social-container">
                        <a class="social" href="{{ route('google.login') }}"><i class="fab fa-google-plus-g"></i></a>
                    </div>
                    <span>hoặc sử dụng email của bạn để đăng ký</span>
                    <input class="input-login" name="email_register" placeholder="Email" type="email"
                        value="{{ old('email_register') }}" />
                    <div class="center eye-wrap">
                        <input class="input-login" id="password_register" maxlength="20" name="password_register"
                            placeholder="Mật khẩu" type="password" />
                        <div class="eye slash eye_register">
                            <div></div>
                            <div></div>
                        </div>
                    </div>

                    <button class="button-login" name="" type="submit">Đăng ký</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="{{ route('login') }}" method="post">
                    <h1 class="m-0 fw-bold">Đăng nhập</h1>
                    <div class="social-container">
                        <a class="social" href="{{ route('google.login') }}"><i class="fab fa-google-plus-g"></i></a>
                    </div>
                    <span>hoặc tài khoản của bạn</span>
                    <input class="input-login" name="email" placeholder="Email" type="email" />
                    <div class="center eye-wrap">
                        <input class="input-login" id="password_login" name="password" placeholder="Mật khẩu" type="password" />
                        <div class="eye slash eye_login">
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <a href="{{ route('forgotPassword') }}">Quên mật khẩu?</a>
                    <button class="button-login mt-2" type="submit">Đăng nhập</button>
                    @csrf
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1 class="m-0 fw-bold">Xin chào!</h1>
                        <p class="descriptive">Vui lòng đăng nhập bằng tài khoản của bạn</p>
                        <button class="button-login ghost" id="signIn">Đăng ký</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1 class="m-0 fw-bold">Xin chào!</h1>
                        <p class="descriptive">Nhập thông tin của bạn và bắt đầu với chúng tôi</p>
                        <button class="button-login ghost" id="signUp">Đăng ký</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('after-styles')
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('script')
    <script type="text/javascript">
        $('#signUp').click(() => {
            $("#container").addClass('right-panel-active')
        });

        $('#signIn').click(() => {
            $("#container").removeClass('right-panel-active')
        });


        $('.eye_register').click(() => {
            $('.eye_register').toggleClass('slash');
            let password = $('#password_register');
            if ($(password).attr('type') === 'password') {
                $(password).attr('type', 'text');
            } else {
                $(password).attr('type', 'password');
            }
        })

        $('.eye_login').click(() => {
            $('.eye_login').toggleClass('slash');
            let password = $('#password_login');
            if ($(password).attr('type') === 'password') {
                $(password).attr('type', 'text');
            } else {
                $(password).attr('type', 'password');
            }
        })
        
    </script>
@endsection
