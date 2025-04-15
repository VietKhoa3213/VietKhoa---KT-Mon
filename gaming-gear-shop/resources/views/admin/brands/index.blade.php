@extends('admin.layout_admin.master') 
@section('title', 'Quản lý Thương Hiệu')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Danh sách Thương Hiệu</h1>
    <div class="mb-3">
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Thêm Thương Hiệu Mới</a>
    </div>

    {{-- Hiển thị thông báo --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Logo</th>
                            <th>Tên Thương Hiệu</th>
                            <th>Mô tả</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>
                                    {{--  @if($brand->logo)
                                        <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}" height="50" class="img-thumbnail-admin">
                                    @endif  --}}

                                    @if($brand->logo)
                                        
                                        @if (\Str::startsWith($brand->logo, 'preview/image/brand/'))
                                            <img src="{{ asset($brand->logo) }}"
                                                alt="{{ $brand->logo }}"
                                                class="img-thumbnail-admin" style="width: 172px; height: 130px;object-fit: contain;">
                                        @else
                                            <img src="{{ asset('preview/image/brand/' . $brand->logo) }}"
                                                alt="{{ $brand->logo }}"
                                                class="img-thumbnail-admin"style="width: 170px; height: 110px;object-fit: contain;" >
                                        @endif
                                    @else
                                        <small>Không có ảnh</small>
                                    @endif
                                </td>
                                <td>{{ $brand->name }}</td>
                                <td>{{ Str::limit($brand->description, 50) }}</td>
                                <td>{{ $brand->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn chắc chắn muốn xóa thương hiệu này? Lưu ý: Không thể xóa nếu có sản phẩm thuộc thương hiệu này.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Chưa có thương hiệu nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="d-flex justify-content-center">
                {{ $brands->links() }}
             </div>
        </div>
    </div>
</div>
@endsection