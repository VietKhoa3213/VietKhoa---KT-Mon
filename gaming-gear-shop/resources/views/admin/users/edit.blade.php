@extends('admin.layout_admin.master') 
@section('title', 'Chỉnh Sửa Người Dùng')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Chỉnh Sửa: {{ $user->name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
         <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Họ và Tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="password">Mật khẩu mới (Để trống nếu không đổi)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}">
                        </div>
                        <div class="form-group">
                            <label for="gender">Giới tính</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="" {{ old('gender', $user->gender) == '' ? 'selected' : '' }}>-- Chọn --</option>
                                <option value="Nam" {{ old('gender', $user->gender) == 'Nam' ? 'selected' : '' }}>Nam</option>
                                <option value="Nữ" {{ old('gender', $user->gender) == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                <option value="Khác" {{ old('gender', $user->gender) == 'Khác' ? 'selected' : '' }}>Khác</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="level">Quyền <span class="text-danger">*</span></label>
                            <select name="level" id="level" class="form-control" required {{ Auth::id() === $user->id ? 'disabled' : '' }}> {{-- Không cho sửa quyền của chính mình --}}
                                <option value="1" {{ old('level', $user->level) == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ old('level', $user->level) == 2 ? 'selected' : '' }}>Staff</option>
                                <option value="3" {{ old('level', $user->level) == 3 ? 'selected' : '' }}>Customer</option>
                            </select>
                             @if(Auth::id() === $user->id)
                                <small class="text-warning">Bạn không thể thay đổi quyền của chính mình.</small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label>Ảnh đại diện hiện tại</label>
                           
                                <div>
                                   @if($user->avatar)
                                        @if (\Str::startsWith($user->avatar, 'preview/image/user/'))
                                            <img src="{{ asset($user->avatar) }}"
                                                alt="{{ $user->name }}"
                                                height="80" width="80"
                                                class="img-thumbnail mb-2"
                                                style="object-fit: cover; border-radius: 50%; w">
                                        @else
                                            <img src="{{ asset('preview/image/user/' . $user->avatar) }}"
                                                alt="{{ $user->name }}"
                                                height="80" width="80" 
                                                class="img-thumbnail mb-2"
                                                style="object-fit: cover; border-radius: 50%;">
                                        @endif
                                    @else
                                        <img src="{{ asset('preview/image/user/default.jpg') }}"
                                            alt="{{ $user->name }} (Default)"
                                            height="80" width="80" 
                                            class="img-thumbnail mb-2"
                                            style="object-fit: cover; border-radius: 50%; background-color: #eee;"> 
                                    @endif
                                </div>
                                <label for="avatar">Chọn ảnh mới (để trống nếu không đổi)</label>
                                <input type="file" class="form-control-file" id="avatar" name="avatar">
                            </div>
                            <small class="form-text text-muted">Tối đa 1MB.</small>
                            @error('avatar')
                                <span class="text-danger d-block mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </div>
    </form>
</div>
@endsection