@extends('admin.layout_admin.master') 
@section('title', 'Quản lý Sản Phẩm')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Danh sách Sản Phẩm</h1>
    <div class="mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Thêm Sản Phẩm Mới</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Ảnh</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Loại SP</th>
                            <th>Thương hiệu</th>
                            <th>Giá</th>
                            <th>SL Tồn</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if($product->image)    
                                        @if (\Str::startsWith($product->image, 'preview/image/product/'))
                                            <img src="{{ asset($product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="img-thumbnail-admin" style="width: 172px; height: 130px;object-fit: contain;">
                                        @else
                                            <img src="{{ asset('preview/image/product/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="img-thumbnail-admin"style="width: 172px; height: 135px;object-fit: contain; " >
                                        @endif
                                    @else
                                        <small>Không có ảnh</small>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td>{{ $product->brand->name ?? 'N/A' }}</td>
                                <td>{{ number_format($product->price, 0, ',', '.') }}₫</td>
                                <td>{{ $product->stock_quantity }}</td>
                                <td>
                                    @if($product->status)
                                        <span class="badge badge-success">Đang bán</span>
                                    @else
                                        <span class="badge badge-secondary">Ngừng bán</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning btn-sm">Sửa</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn chắc chắn muốn xóa sản phẩm này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Không có sản phẩm nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection