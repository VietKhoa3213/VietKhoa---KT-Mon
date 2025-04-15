@extends('admin.layout_admin.master')

@section('title', 'Quản lý Đánh giá')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Quản lý Đánh giá</h1>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

    <ul class="nav nav-tabs mb-3">
     <li class="nav-item"><a class="nav-link {{ !$status ? 'active' : '' }}" href="{{ route('reviews.index') }}">Tất cả</a></li>
     @foreach($allStatuses as $statusKey => $statusText)
         <li class="nav-item"><a class="nav-link {{ $status == $statusKey ? 'active' : '' }}" href="{{ route('reviews.index', ['status' => $statusKey]) }}">{{ $statusText }}</a></li>
     @endforeach
    </ul>


    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Người đánh giá</th>
                            <th>Sản phẩm</th>
                            <th class="text-center">Sao</th>
                            <th>Bình luận</th>
                            <th>Ngày gửi</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reviews as $review)
                            <tr>
                                <td>{{ $review->id }}</td>
                                <td>{{ $review->user->name ?? '[N/A]' }}</td>
                                <td>{{ $review->product->name ?? '[N/A]' }}</td>
                                <td class="text-center">{{ $review->rating }}★</td>
                                <td>{{ Str::limit($review->comment, 100) }}</td>
                                <td>{{ $review->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                        <span class="badge badge-{{ $review->status_class }}">
                                            {{ $review->status_text }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($review->status == \App\Models\Review::STATUS_PENDING)
                                            <form action="{{ route('reviews.approve', $review) }}" method="POST" class="d-inline-block" title="Duyệt đánh giá này">
                                                @csrf
                                                @method('PATCH') 
                                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i></button>
                                            </form>
                                             <form action="{{ route('reviews.reject', $review) }}" method="POST" class="d-inline-block me-1" title="Từ chối đánh giá này">
                                                    @csrf
                                                    @method('PATCH') 
                                                    <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-ban"></i></button>
                                                </form>
                                        @endif
                                        <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="d-inline-block ml-1" onsubmit="return confirm('Bạn chắc chắn muốn xóa đánh giá này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Xóa"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                            <tr><td colspan="8" class="text-center">Không có đánh giá nào.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
</div>
@endsection