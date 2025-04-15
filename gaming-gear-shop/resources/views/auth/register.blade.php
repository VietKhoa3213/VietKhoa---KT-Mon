@extends('layout.master') 

@section('title', 'Đăng ký tài khoản')

@section('content')
<div class="container" style="max-width: 500px; margin: 50px auto;">
    <h1 style="text-align: center; margin-bottom: 30px;">Đăng Ký Tài Khoản</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px; border: 1px solid red; padding: 10px; border-radius: 5px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Name --}}
        <div style="margin-bottom: 15px;">
            <label for="name" style="display: block; margin-bottom: 5px;">Họ và Tên:</label>
            <input type="text" name="fullname" id="name" value="{{ old('fullname') }}" required autofocus
                   style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            @error('fullname')
                <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Email --}}
        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; margin-bottom: 5px;">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                   style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
             @error('email')
                <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
            @enderror
        </div>


        {{-- Phone --}}
        <div style="margin-bottom: 15px;">
            <label for="phone" style="display: block; margin-bottom: 5px;">Số điện thoại:</label>
            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                   style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
             @error('phone') 
                <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Address --}}
        <div style="margin-bottom: 15px;">
            <label for="address" style="display: block; margin-bottom: 5px;">Địa chỉ:</label>
            <input type="text" name="address" id="address" value="{{ old('address') }}"
                   style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
             @error('address') 
                <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Gender --}}
        <div style="margin-bottom: 15px;">
            <label for="gender" style="display: block; margin-bottom: 5px;">Giới tính:</label>
            <select name="gender" id="gender" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; background-color: white;">
                <option value="" {{ old('gender') == '' ? 'selected' : '' }} disabled>-- Chọn giới tính --</option>
                <option value="Nam" {{ old('gender') == 'Nam' ? 'selected' : '' }}>Nam</option>
                <option value="Nữ" {{ old('gender') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                <option value="Khác" {{ old('gender') == 'Khác' ? 'selected' : '' }}>Khác</option>
            </select>
             @error('gender') 
                <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
            @enderror
        </div>



        {{-- Password --}}
        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; margin-bottom: 5px;">Mật khẩu:</label>
            <input type="password" name="password" id="password" required
                   style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
             @error('password')
                <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div style="margin-bottom: 20px;">
            <label for="password_confirmation" style="display: block; margin-bottom: 5px;">Xác nhận mật khẩu:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                   style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        {{-- Submit Button --}}
        <div>
            <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
                Đăng Ký
            </button>
             <a href="{{ route('login') }}" style="float: right; margin-top: 10px;">Đã có tài khoản? Đăng nhập</a>
        </div>
    </form>
</div>
@endsection