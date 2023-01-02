<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="ie=edge" http-equiv="X-UA-Compatible">
    <meta content="{{ csrf_token() }}" name="csrf-token">
    <link href="{{ asset('images/logo/icon.svg') }}" rel="shortcut icon" type="image/jpg" />
    <link href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" rel="stylesheet" type="text/css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
    <link href="http://kenwheeler.github.io/slick/slick/slick-theme.css" rel="stylesheet" type="text/css" />
    @stack('before-styles')
    <link href="{{ asset('css/adminlte.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/frontend.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    @stack('after-styles')
</head>

<body>
    <div class="d-flex vh-100 vw-100 justify-content-center align-items-center bg-secondary"
        style="--bs-bg-opacity: .2;">
        <div class="success shadow p-3 mb-5 bg-body rounded text-center">
            <div class="icon">
                <i class="fa-solid fa-check"></i>
            </div>
            <h2 class="header-success">Thanh toán thành công!</h2>
            <div class="text-success">Cảm ơn bạn đã đặt hàng, vui lòng kiểm tra đơn hàng ở email.</div>
            <a class="btn btn-success btn-index"href="{{ route('index') }}">Trang chủ</a>

        </div>
    </div>
    @stack('before-scripts')
    <script src="{{ asset(mix('js/app.js')) }}"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/frontend.js') }}"></script>
    @stack('after-scripts')
    @yield('script')
</body>

</html>
<style>
    .success {
        width: 400px;
        height: 300px;
        position: relative;
    }

    .icon {
        position: absolute;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: rgb(14, 211, 57);
        left: 40%;
        transform: translateY(-50%);
        text-align: center;
    }

    .icon i {
        font-size: 50px;
        color: #FFFFFF;
        transform: translateY(15px);
    }

    .header-success {
        color: #000;
        margin-top: 80px;
        font-size: 30px;
        font-weight: bold;
    }

    .text-success {
        color: #000;
        margin-top: 10px;
        padding: 0 10px;
        font-size: 16px;
        font-weight: bold;
    }

    .btn-index {
        font-size: 16px;
        margin-top: 30px;
    }
</style>
<script type="text/javascript">
    let deletingAll = browser.history.deleteAll()
</script>


