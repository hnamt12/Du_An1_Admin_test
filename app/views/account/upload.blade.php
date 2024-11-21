@extends('layouts.main')

@section('content')
    <h1 class="mb-4">Thêm Tài Khoản Mới </h1>




    <form action="{{ route('account.storeload') }}" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh </label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Thêm Tài Khoản </button>
        <a href="{{ route('account.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
