@extends('admin.layout_admin.master')
@section('title', 'Thêm Tin Tức Mới')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Thêm Tin Tức Mới</h1>

    @if ($errors->any())
        <div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="form-group">
                    <label for="title">Tiêu đề <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                </div>

                <div class="form-group">
                    <label for="content">Nội dung <span class="text-danger">*</span></label>
                    <textarea class="form-control wysiwyg-editor" id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Hình ảnh đại diện</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    <small class="form-text text-muted">Định dạng: jpeg, png, jpg, gif, svg, webp. Tối đa 2MB.</small>
                </div>

                 <div class="form-group">
                    <label for="status">Trạng thái <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Xuất bản</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Bản nháp</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm Mới</button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Hủy</a>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/4.25.1/standard-all/ckeditor.js"></script>
<script>
     document.addEventListener('DOMContentLoaded', function() {
         document.querySelectorAll('.wysiwyg-editor').forEach(function(node) {
            CKEDITOR.replace(node.id);
         });
     });
</script>
@endpush