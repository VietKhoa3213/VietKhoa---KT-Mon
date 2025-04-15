@extends('admin.layout_admin.master') 
@section('title', 'Thêm Thương Hiệu Mới')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Thêm Thương Hiệu Mới</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Tên Thương Hiệu <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" class="form-control-file" id="logo" name="logo">
                    <small class="form-text text-muted">Định dạng: jpeg, png, jpg, gif, svg, webp. Tối đa 1MB.</small>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm Mới</button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </div>
    </form>
</div>
@endsection