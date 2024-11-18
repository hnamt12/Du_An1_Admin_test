@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h1>Chi tiết người dùng</h1>
    <div class="card">
        <div class="card-header bg-primary text-white">
            Thông tin người dùng
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $user['user_id'] }}</p>
            <p><strong>Tên người dùng:</strong> {{ $user['username'] }}</p>
            <p><strong>Email:</strong> {{ $user['email'] }}</p>
            <p><strong>Số điện thoại:</strong> {{ $user['phone_number'] ?? 'Không có' }}</p>
            <p><strong>Ngày tạo:</strong> {{ $user['created_at'] }}</p>
            <p><strong>Ngày cập nhật:</strong> {{ $user['updated_at'] }}</p>
        </div>
        <div class="card-footer">
            <a href="account.index" class="btn btn-secondary">Quay lại danh sách</a>
            <a href="account.edit?id={{ $user['user_id'] }}" class="btn btn-warning">Chỉnh sửa</a>
            <a href="acount.delete?id={{ $user['user_id'] }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
        </div>
    </div>
</div>
@endsection
