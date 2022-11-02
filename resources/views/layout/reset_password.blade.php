@extends('app')
@section('content')
<div class="d-flex flex-column overflow-hidden p-0">
    <div class="row align-items-center justify-content-center
        min-vh-100 g-0">
      <div class="col-12 col-md-8 col-lg-4 border-3">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="mb-4">
              <h5>Quên mật khẩu?</h5>
              <p class="mb-2">
                Đặt lại mật khẩu để đăng nhập bằng tài khoản của bạn
              </p>
            </div>
            <form>
              <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu mới</label>
                <input type="password" id="email" class="form-control" name="password" placeholder="Mật khẩu"
                  required="">
              </div>
              <div class="mb-3">
                <label for="comfirm-password" class="form-label">Xác nhận mật khẩu</label>
                <input type="password" id="email" class="form-control" name="comfirm-password" placeholder="Xác nhận mật khẩu"
                  required="">
              </div>
              <div class="mb-3 d-grid">
                <button type="submit" class="btn btn-primary">
                  Đặt lại mật khẩu
                </button>
              </div>
              <span>Quay lại trang đăng nhập ? <a href="{{ route('login') }}">Đăng nhập</a></span>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection