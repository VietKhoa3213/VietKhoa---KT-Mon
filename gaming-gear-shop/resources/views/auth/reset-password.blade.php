@extends('layout.master') 

@section('title', 'Đặt Lại Mật Khẩu')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                 <div class="card-header bg-light py-3">
                    <h3 class="mb-0 text-center">Đặt Lại Mật Khẩu Mới</h3>
                </div>
                <div class="card-body p-4">

                     
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.store') }}"> 
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label for="email" class="form-label">Địa chỉ Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required readonly>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu mới</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Nhập mật khẩu mới (ít nhất 6 ký tự)">
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Xác nhận mật khẩu mới</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Nhập lại mật khẩu mới">
                        </div>

                        <div class="d-grid gap-2">
                             <button type="submit" class="btn btn-primary btn-lg">
                                Đặt Lại Mật Khẩu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection