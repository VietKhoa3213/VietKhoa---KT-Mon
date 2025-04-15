@extends('layout.master')

@section('title', 'Liên hệ với chúng tôi')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4 text-center">Liên Hệ</h1>
            <p class="text-center text-muted mb-4">Chúng tôi luôn sẵn lòng lắng nghe bạn. Vui lòng điền vào form dưới đây.</p>

            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Nội dung tin nhắn <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg">Gửi Liên Hệ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection