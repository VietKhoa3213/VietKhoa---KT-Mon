@extends('admin.layout_admin.master') 

@section('title', 'Quản lý Loại Sản Phẩm')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Danh sách Loại Sản Phẩm</h1>

    <div class="mb-3">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Thêm Loại Sản Phẩm Mới</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Hình ảnh</th>
                            <th>Tên Loại</th>
                            <th>Mô tả</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>
                                    @if($category->image)
                                        
                                        @if (\Str::startsWith($category->image, 'preview/image/category/'))
                                            <img src="{{ asset($category->image) }}"
                                                alt="{{ $category->name }}"
                                                class="img-thumbnail-admin" style="width: 172px; height: 130px;object-fit: contain;">
                                        @else
                                            <img src="{{ asset('preview/image/category/' . $category->image) }}"
                                                alt="{{ $category->name }}"
                                                class="img-thumbnail-admin"style="width: 172px; height: 135px;object-fit: contain; " >
                                        @endif
                                    @else
                                        <small>Không có ảnh</small>
                                    @endif
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>{{ Str::limit($category->description, 50) }}</td> 
                                <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning btn-sm">Sửa</a>

                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa loại sản phẩm này không?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Không có loại sản phẩm nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="d-flex justify-content-center">
                {{ $categories->links() }}
             </div>
        </div>
    </div>
</div>
@endsection