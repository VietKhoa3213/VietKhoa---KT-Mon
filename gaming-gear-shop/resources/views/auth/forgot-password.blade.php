@extends('layout.master') 

@section('title', 'Quên Mật Khẩu')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6"> 
            <div class="card shadow-sm">
                <div class="card-header bg-light py-3">
                    <h3 class="mb-0 text-center">Quên Mật Khẩu</h3>
                </div>
                <div class="card-body p-4">
                    <p class="text-muted text-center mb-4">Vui lòng nhập địa chỉ email đã đăng ký. Chúng tôi sẽ gửi cho bạn một liên kết để đặt lại mật khẩu.</p>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Địa chỉ Email:</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Nhập email của bạn">
                       
                        </div>

                        <div class="d-grid gap-2"> 
                            <button type="submit" class="btn btn-primary btn-lg">
                                Gửi Liên Kết Đặt Lại Mật Khẩu
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                         <a href="{{ route('login') }}">Quay lại trang Đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection