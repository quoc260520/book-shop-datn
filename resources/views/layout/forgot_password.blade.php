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
                Nhập email đăng ký tài khoản của bạn để đặt lại mật khẩu
              </p>
            </div>
            <form method="post" action="{{ route('forgotPassword') }}">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" name="email" placeholder="Email"
                  required>
                  @error('email')
                  <p class="text-danger mb-3">{{ $message }}</p>
                 @enderror
              </div>
              <div class="mb-3 d-grid">
                <button type="submit" class="btn btn-primary">
                  Đặt lại mật khẩu
                </button>
              </div>
              <span>Bạn không có tài khoản ? <a href="{{ route('login') }}">Đăng ký</a></span>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection