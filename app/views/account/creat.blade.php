@extends('layouts.main')

@section('content')
    <h1 class="mb-4">Thêm Tài Khoản Mới </h1>


    <?php
    if (isset($_SESSION['success'])) {
        $class = $_SESSION['success'] ? 'alert-success' : 'alert-danger';
    
        echo "<div class='alert $class'> {$_SESSION['msg']} </div>";
    
        unset($_SESSION['success']);
        unset($_SESSION['msg']);
    }
    ?>

    <?php if (!empty($_SESSION['errors'])): ?>

    <div class="alert alert-danger">

        <ul>
            <?php foreach ($_SESSION['errors'] as $value): ?>

            <li> <?= $value ?> </li>

            <?php endforeach; ?>
        </ul>

    </div>

    <?php unset($_SESSION['errors']); ?>



    <?php endif; ?>
    <form action="{{ route('account.store') }}" method="POST" enctype="multipart/form-data">
      
        <div class="mb-3">
            <label for="name" class="form-label">Tên Tài Khoản :</label>
            <input type="text" class="form-control" name="name">
            {{-- <input type="text" class="form-control" name="username" required> --}}
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
            {{-- <input type="email" class="form-control" id="email" name="email" required> --}}
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password">
            {{-- <input type="password" class="form-control" id="password" name="password" required> --}}
        </div>
        <div class="mb-3">
            <label for="phone_number" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh </label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Thêm Tài Khoản </button>
        <a href="{{ route('account.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection
