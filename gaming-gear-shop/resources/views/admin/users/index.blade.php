@extends('admin.layout_admin.master') 
@section('title', 'Quản lý Người Dùng')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Danh sách Người Dùng</h1>
    <div class="mb-3">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Thêm Người Dùng Mới</a>
    </div>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Avatar</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Quyền</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    @if($user->avatar)
                                        @if (\Str::startsWith($user->avatar, 'preview/image/user/'))
                                            <img src="{{ asset($user->avatar) }}"
                                                alt="{{ $user->name }}"
                                                height="80" width="80"
                                                class="img-thumbnail mb-2"
                                                style="object-fit: cover; border-radius: 50%;width: 80px; height: 80px;">
                                        @else
                                            <img src="{{ asset('preview/image/user/' . $user->avatar) }}"
                                                alt="{{ $user->name }}"
                                                height="80" width="80" 
                                                class="img-thumbnail mb-2"
                                                style="object-fit: cover; border-radius: 50%;width: 80px; height: 80px;">
                                        @endif
                                    @else
                                        <img src="{{ asset('preview/image/user/default.jpg') }}"
                                            alt="{{ $user->name }} (Default)"
                                            height="80" width="80" 
                                            class="img-thumbnail mb-2"
                                            style="object-fit: cover; border-radius: 50%; background-color: #eee;width: 80px; height: 80px;">
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ Str::limit($user->address, 30) }}</td>
                                <td>
                                    @if($user->level == 1) <span class="badge badge-danger">Admin</span>
                                    @elseif($user->level == 2) <span class="badge badge-warning">Staff</span>
                                    @else <span class="badge badge-info">Customer</span>
                                    @endif
                                    ({{ $user->level }})
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">Sửa</a>
                                    @if(Auth::id() !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn chắc chắn muốn xóa người dùng này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="8" class="text-center">Chưa có người dùng nào.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="d-flex justify-content-center">
                {{ $users->links() }}
             </div>
        </div>
    </div>
</div>
@endsection