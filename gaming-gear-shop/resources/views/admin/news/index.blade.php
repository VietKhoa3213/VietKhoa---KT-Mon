
@extends('admin.layout_admin.master')
@section('title', 'Quản lý Tin Tức')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Danh sách Tin Tức</h1>
    <div class="mb-3">
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">Thêm Tin Tức Mới</a>
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
                            <th>Tác giả</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($news as $newsItem)
                            <tr>
                                <td>{{ $newsItem->id }}</td>
                                <td>
                                     @if($newsItem->image)
                                        @if (\Str::startsWith($newsItem->image, 'preview/image/news/'))
                                            <img src="{{ asset($newsItem->image) }}" 
                                                style="width: 202px; height: 130px;object-fit: contain;"
                                                alt="{{ $newsItem->title ?? 'Slide' }}"
                                                height="60" class="img-thumbnail-admin"> 
                                        @else
                                            <img src="{{ asset('preview/image/news/' . $newsItem->image) }}"
                                                style="width: 202px; height: 130px;object-fit: contain;"
                                                alt="{{ $newsItem->title ?? 'Slide' }}"
                                                height="60" class="img-thumbnail-admin"> 
                                        @endif
                                    @else
                                        <small>Không có ảnh</small>
                                    @endif
                                </td>
                                <td>{{ $newsItem->title }}</td>
                                <td>{{ $newsItem->author->name ?? 'N/A' }}</td>
                                <td>
                                    @if($newsItem->status)
                                        <span class="badge badge-success">Xuất bản</span>
                                    @else
                                        <span class="badge badge-secondary">Bản nháp</span>
                                    @endif
                                </td>
                                <td>{{ $newsItem->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.news.edit', $newsItem) }}" class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.news.destroy', $newsItem) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn chắc chắn muốn xóa tin tức này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">Chưa có tin tức nào.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="d-flex justify-content-center">
                {{ $news->links() }} 
             </div>
        </div>
    </div>
</div>
@endsection