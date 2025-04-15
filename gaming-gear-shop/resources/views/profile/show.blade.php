@extends('layout.master')

@section('title', 'Thông tin tài khoản')



@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8"> 
             <h1 class="mb-4 text-center h2">Thông Tin Tài Khoản</h1>

             @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
             @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
             @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
             @endif

             <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="card shadow-sm">
                    <div class="card-body p-4">

                         <div class="text-center mb-4">
                            @php
                                $avatarFilename = $user->avatar ?? null; 
                                $defaultImage = 'preview/image/user/default.jpg'; 
                                $imageUrl = asset($defaultImage); 

                                if ($avatarFilename) {
                                    $expectedRelativePath = 'preview/image/user/' . $avatarFilename;

                                    if ($avatarFilename !== 'default.jpg' && File::exists(public_path($expectedRelativePath))) {
                                        $imageUrl = asset($expectedRelativePath);
                                    }
                                   

                                }
                                if ($imageUrl === asset($defaultImage) && !File::exists(public_path($defaultImage))) {
                                    $imageUrl = asset('images/placeholder_avatar.png'); 
                                }

                            @endphp

                            <img src="{{ $imageUrl }}"
                                alt="Ảnh đại diện của {{ $user->name }}"
                                class="profile-avatar" 
                                id="avatarPreview"> 

                            <div class="mt-2">
                                <label for="avatar" class="btn btn-sm btn-outline-secondary">Đổi ảnh</label>
                                <input type="file" id="avatar" name="avatar" class="d-none" accept="image/*"> 
                                @error('avatar') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror
                            </div>
                            <small class="form-text text-muted d-block">Ảnh JPG, PNG, GIF, WEBP, tối đa 1MB.</small>
                        </div>

                        <h5 class="form-section-title">Thông tin cơ bản</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email_disabled" value="{{ $user->email }}" disabled readonly>
                                <small class="text-muted">Không thể thay đổi email.</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                            </div>
                             <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Giới tính</label>
                                <select name="gender" id="gender" class="form-select"> 
                                    <option value="" {{ old('gender', $user->gender) == '' ? 'selected' : '' }}>-- Chọn --</option>
                                    <option value="Nam" {{ old('gender', $user->gender) == 'Nam' ? 'selected' : '' }}>Nam</option>
                                    <option value="Nữ" {{ old('gender', $user->gender) == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                    <option value="Khác" {{ old('gender', $user->gender) == 'Khác' ? 'selected' : '' }}>Khác</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}">
                            </div>
                        </div>

                         <h5 class="form-section-title">Đổi mật khẩu (Để trống nếu không đổi)</h5>
                         <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                                @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Mật khẩu mới</label>
                                <input type="password" class="form-control" id="password" name="password">
                                 @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Xác nhận mật khẩu mới</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>

                         <div class="mt-4 text-center">
                             <button type="submit" class="btn btn-primary btn-lg">Lưu thay đổi</button>
                         </div>

                    </div> 
                </div> 
             </form>

              <div class="mt-5 text-center pt-4 border-top">
                  <h5 class="mb-3">Lịch sử mua hàng</h5>
                  <a href="{{ route('profile.orders') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-history mr-1"></i> Xem Đơn Hàng Của Bạn
                </a>
              </div>

        </div> 
    </div> 
</div> 
@endsection

@section('js')
<script>
     const avatarInput = document.getElementById('avatar');
     const avatarPreview = document.getElementById('avatarPreview'); 
     if(avatarInput && avatarPreview) {
         avatarInput.addEventListener('change', function(event) {
             const file = event.target.files[0];
             if (file && file.type.startsWith('image/')){ 
                 const reader = new FileReader();
                 reader.onload = function(e) {
                     avatarPreview.src = e.target.result;
                 }
                 reader.readAsDataURL(file);
             } else {
                 avatarPreview.src = '{{ $imageUrl }}'; 
             }
         });
     }
 </script>
@endsection
