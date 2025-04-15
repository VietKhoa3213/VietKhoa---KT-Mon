@extends('admin.layout_admin.master') 

@section('title', 'Quản lý Liên Hệ')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Tin nhắn Liên hệ</h1>

    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif

    <ul class="nav nav-tabs mb-3">
         <li class="nav-item">
             <a class="nav-link {{ !$status ? 'active' : '' }}" href="{{ route('contacts.index') }}">Tất cả</a>
         </li>
        @foreach($allStatuses as $statusCode => $statusText)
         <li class="nav-item">
             <a class="nav-link {{ $status == $statusCode ? 'active' : '' }}" href="{{ route('contacts.index', ['status' => $statusCode]) }}">{{ $statusText }}</a>
         </li>
        @endforeach
    </ul>


    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Người gửi</th>
                            <th>Email</th>
                            <th>Tiêu đề</th>
                            <th>Ngày gửi</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contacts as $contact)
                            <tr>
                                <td>{{ $contact->id }}</td>
                                <td>{{ $contact->name }}</td>
                                <td><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                                <td>{{ $contact->subject ?? '(Không có)' }}</td>
                                <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span class="badge badge-{{ $contact->status_class }}">
                                        {{ $contact->status_text }}
                                    </span>
                                     @if($contact->replied_at)
                                        <br><small class="text-muted">({{ $contact->replied_at->format('d/m/Y H:i') }})</small>
                                     @endif
                                </td>
                                <td>
                                    {{-- Link tới trang trả lời --}}
                                    <a href="{{ route('contacts.reply', $contact) }}" class="btn btn-primary btn-sm" title="Xem và Phản hồi">
                                        <i class="fa fa-reply"></i> Phản hồi
                                    </a>
                                     {{-- Nút xóa --}}
                                     <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline-block ml-1" onsubmit="return confirm('Bạn chắc chắn muốn xóa liên hệ này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Xóa">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center">Không có tin nhắn liên hệ nào.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             <div class="d-flex justify-content-center">
                {{ $contacts->links() }}
             </div>
        </div>
    </div>
</div>
@endsection