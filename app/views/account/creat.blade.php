@extends('layouts.main')

@section('content')
    <h1 class="mb-4">Thêm Tài Khoản Mới </h1>

    <form action="{{ route('account.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Tên Tài Khoản :</label>
            <input type="text" class="form-control" name="username" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number">
        </div>

        <button type="submit" class="btn btn-primary">Thêm truyện</button>
        <a href="{{ route('account.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
