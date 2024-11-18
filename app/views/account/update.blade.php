@extends('layout.main')

@section('content')
<div class="container mt-4">
    <h1>Chỉnh sửa người dùng</h1>
    <form action="/users/update?id={{ $user['user_id'] }}" method="POST">
        <div class="mb-3">
            <label for="username" class="form-label">Tên người dùng</label>
            <input type="text" name="username" class="form-control" value="{{ $user['username'] }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $user['email'] }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Số điện thoại</label>
            <input type="text" name="phone_number" class="form-control" value="{{ $user['phone_number'] }}">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="/users" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
