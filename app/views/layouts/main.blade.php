<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    @include('layouts.partials.css')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar --> 
        <!-- Thanh điều hướng nav  -->
        @include('layouts.partials.sideBar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <!-- Bắt đầu content -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <!-- Thanh top bar , tìm kiếm , login-out , thông báo ,tài khoản  -->
                @include('layouts.partials.topBar')

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('layouts.partials.footer')

            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="<?=BASE_URL?>/assets/admin/#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <!-- Điều hướng logout  -->
    @include('layouts.partials.logout')


    @include('layouts.partials.js')
</body>

</html>