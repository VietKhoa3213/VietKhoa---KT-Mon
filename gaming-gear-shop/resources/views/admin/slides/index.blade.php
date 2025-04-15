@extends('admin.layout_admin.master') 
@section('title', 'Quản lý Slide Banner')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Danh sách Slide Banner</h1>
    <div class="mb-3">
        <a href="{{ route('admin.slides.create') }}" class="btn btn-primary">Thêm Slide Mới</a>
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
                            <th>Ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Link</th>
                            <th>Thứ tự</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($slides as $slide)
                            <tr>
                                <td>{{ $slide->id }}</td>
                                <td>
                                    @if($slide->image)
                                        @if (\Str::startsWith($slide->image, 'preview/image/slides/'))
                                            <img src="{{ asset($slide->image) }}" 
                                                style="width: 202px; height: 130px;object-fit: contain;"
                                                alt="{{ $slide->title ?? 'Slide' }}"
                                                height="60" class="img-thumbnail-admin"> 
                                        @else
                                            <img src="{{ asset('preview/image/slides/' . $slide->image) }}"
                                                style="width: 202px; height: 130px;object-fit: contain;"
                                                alt="{{ $slide->title ?? 'Slide' }}"
                                                height="60" class="img-thumbnail-admin"> 
                                        @endif
                                    @else
                                        <small>Không có ảnh</small>
                                    @endif
                                </td>
                                <td>{{ $slide->title }}</td>
                                <td><a href="{{ $slide->link }}" target="_blank">{{ $slide->link }}</a></td>
                                <td>{{ $slide->sort_order }}</td>
                                <td>
                                    @if($slide->status)
                                        <span class="badge badge-success">Hoạt động</span>
                                    @else
                                        <span class="badge badge-secondary">Ẩn</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.slides.edit', $slide) }}" class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.slides.destroy', $slide) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn chắc chắn muốn xóa slide này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">Chưa có slide nào.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="d-flex justify-content-center">
                {{ $slides->links() }}
             </div>
        </div>
    </div>
</div>
@endsection