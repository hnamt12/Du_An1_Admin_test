@extends('layouts.main')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-primary">Danh sách Users</h3>
        <a href="{{ route('account.creat') }}" class="btn btn-success btn-lg">
            <i class="bi bi-plus-circle"></i> Thêm User
        </a>
       
    </div>
    <?php
    if (isset($_SESSION['success'])) {
        $class = $_SESSION['success'] ? 'alert-success' : 'alert-danger';
    
        echo "<div class='alert $class'> {$_SESSION['msg']} </div>";
    
        unset($_SESSION['success']);
        unset($_SESSION['msg']);
    }
    //
    ?>
    <table class="table table-hover table-bordered align-middle">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Tên đăng nhập</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Hình Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user['user_id'] }}</td>
                    <td>{{ $user['name'] }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user['phone_number'] }}</td>
                    <td>
                        @if (!empty($user['image']))
                            <img src="{{ BASE_ASSETS_UPLOADS . $user['image'] }}" alt="" width="120px">
                        @endif
                    </td>

                    {{-- update&id={{$user['id']}} --}}
                    {{-- update/{{$user['id']}} --}}
                    <td class="text-center">
                        {{-- <a href="account.show&id={{$user['id']}}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Sửa
                        </a> --}}
                        {{-- <a href="{{ route('account.show', $user['id']) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil"></i> Chi tiết
                        </a> --}}
                        <a href="account.show&id={{ $user['user_id'] }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil"></i> Chi tiết
                        </a>
                        <a href="account.edit&id={{ $user['user_id'] }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Sửa 
                        </a>
                        <a href="account.destroy&id={{ $user['user_id'] }}"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-danger btn-sm">
                            <i class="bi bi-pencil"></i>Xóa
                        </a>
                        {{-- <form action="account.destroy&id={{$user['id']}}" method="POST" style="display:inline">
                           
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</button>
                        </form> --}}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
