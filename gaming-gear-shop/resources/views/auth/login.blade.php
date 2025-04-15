@extends('layout.master') 

@section('title', 'Đăng nhập')

@section('content')

<div class="container" style="max-width: 500px; margin: 50px auto;">
    <h1 style="text-align: center; margin-bottom: 30px;">Đăng Nhập</h1>
@if (session('status'))
        <div style="color: green; margin-bottom: 15px; border: 1px solid green; padding: 10px; border-radius: 5px;">
            {{ session('status') }}
        </div>
    @endif
    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px; border: 1px solid red; padding: 10px; border-radius: 5px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}"> 
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; margin-bottom: 5px;">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                   style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            @error('email') 
                <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; margin-bottom: 5px;">Mật khẩu:</label>
            <input type="password" name="password" id="password" required
                   style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            @error('password') 
                 <span style="color: red; font-size: 0.9em;">{{ $message }}</span>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label for="remember" style="display: inline-flex; align-items: center; cursor: pointer;">
                <input type="checkbox" name="remember" id="remember" style="margin-right: 5px;">
                <span>Ghi nhớ đăng nhập</span>
            </label>
        </div>

        <div>
            <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
                Đăng Nhập
            </button>
            <a href="{{ route('register') }}" style="float: right; margin-top: 10px;">Chưa có tài khoản? Đăng ký</a>
             
            <a href="/forgot-password" style="display: block; margin-top: 10px; font-size: 0.9em;">Quên mật khẩu?</a>
        </div>
    </form>
</div>
@endsection