<?php

namespace App\Controllers;
use App\Models\AccountModel;
use App\Models\BaseModel;
use Exception;


class AccountController extends BaseController
{

    protected $user;

    public function __construct()
    {
        $this->user = new AccountModel();

    }
    public function index()
    {
        // return $this->view('layouts.compoments.main_dashbord') ; 
        // $data = $this->user->select('*','parent_id> :id ',['id'=>1]) ; 
        // $data = $this->user->delete('category_id> :id ',['id'=>1]);
        // $data = $this->user->update(['name'=>'trang nguu 2 '],'category_id> :id',['id'=>2]) ; 
        // $data = $this->user->get2Top();
        // debug($data) ;         
        // $data = $this->user->insert(['username'=>'trang nguu 2 '  ],'users> :id',['id'=>1]) ; 
        // $users = $this->user->getAll();
        $users = $this->user->select();
        // debug($users) ; 

        return $this->view('account.index', compact('users'));
    }
    public function create()
    {
        return $this->view('account.creat');
    }
    public function createload()
    {
        return $this->view('account.upload');
    }
    public function storeload(){
        
        $data= $_FILES  ; 
        $data['name'] = upload_file('users', $data['image']) ; 
        // debug($data);
        // die ; 
    }
    public function store()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                throw new Exception('Yêu cầu phương thức phải là POST');
            }

            $data = $_POST + $_FILES;
            // debug($data); 
            // die ; 
            $_SESSION['errors'] = [];

            // Validate dữ liệu
            if (empty($data['name']) || strlen($data['name']) > 50) {
                $_SESSION['errors']['name'] = 'Trường name bắt buộc và độ dài không quá 50 ký tự.';
            }

            if (
                empty($data['email'])
                || strlen($data['email']) > 100

                || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)

                || !empty($this->user->find('*', 'email = :email', ['email' => $data['email']]))
            ) {
                $_SESSION['errors']['email'] = 'Trường email bắt buộc, độ dài không quá 100 ký tự và không được trùng';
            }

            if (empty($data['password']) || strlen($data['password']) < 6 || strlen($data['password']) > 30) {
                $_SESSION['errors']['password'] = 'Trường password bắt buộc, độ dài trong khoảng từ 6 đến 30 ký tự.';
            }

            if ($data['image']['size'] > 0) {

                if ($data['image']['size'] > 10  * 1024 * 1024) {
                    $_SESSION['errors']['image_size'] = 'Trường image có dung lượng tối đa 2MB';
                }

                $fileType = $data['image']['type'];
                $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($fileType, $allowedTypes)) {
                    $_SESSION['errors']['image_type'] = 'Xin lỗi, chỉ chấp nhận các loại file JPG, JPEG, PNG, GIF.';
                }
            }

            if (!empty($_SESSION['errors'])) {

                $_SESSION['data'] = $data;

                throw new Exception('Dữ liệu lỗi!');
            }

            // if(is_array($imgCover)){
            //     $data['img_cover'] = upload_file($imgCover,'uploads/posts/') ; 
            // }
            if ($data['image']['size'] > 0) {
                $data['image'] = upload_file('users', $data['image']);
            } else {    
                $data['image'] = null;
            }
            // debug($data);
            // die ; 

            $rowCount = $this->user->insert($data);

            if ($rowCount > 0) {
                $_SESSION['success'] = true;
                $_SESSION['msg'] = 'Thao tác thành công!';
            } else {
                throw new Exception('Thao tác KHÔNG thành công!');
            }
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();
        }

        header('Location: ' . BASE_URL . 'account.index');
        exit();
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        try {

            if (!isset($_GET['id'])) {
                throw new \Exception('Thiếu tham số id ', 99);

            }
            $id = $_GET['id'];

            $user = $this->user->find('*', 'user_id = :id ', ['id' => $id]);
            //   debug( $user); 
            // die ; 
            // if(empty($users))  {
            //     throw new \Exception("User có Id = $id không tồn tại !") ;
            // }

        } catch (\Throwable $th) {
            //throw $th;
            // $_SESSION['success'] = false ; 
            // $_SESSION['msg'] = $th->getMessage();

        }
        // $comic = Comic::findOrFail($comic) ; 
        return $this->view('account.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception('Thiếu tham số "id"', 99);
            }

            $id = $_GET['id'];

            $user = $this->user->find('*', 'user_id = :id', ['id' => $id]);
            // debug($user);
            // die ; 

            if (empty($user)) {
                throw new Exception("User có ID = $id KHÔNG TỒN TẠI!");
            }
            // require_once PATH_VIEW_ADMIN_MAIN; 
        } catch (\Throwable $th) {
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

            // // header('Location: ' . BASE_URL_ADMIN . '&action=users-index');
            // exit();
        }


        return $this->view('account.edit', compact('user'));
    }

    //     /**
//      * Update the specified resource in storage.
//      */
    public function update()
{
    try {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            throw new Exception('Yêu cầu phương thức phải là POST');
        }

        if (!isset($_GET['id'])) {
            throw new Exception('Thiếu tham số "id"', 99);
        }

        $id = $_GET['id'];
    
        $user = $this->user->find('*', 'user_id = :id', ['id' => $id]);

        if (empty($user)) {
            throw new Exception("User có ID = $id KHÔNG TỒN TẠI!");
        }

        $data = $_POST + $_FILES;

        $_SESSION['errors'] = [];

        // Validate dữ liệu
        if (empty($data['name']) || strlen($data['name']) > 50) {
            $_SESSION['errors']['name'] = 'Trường name bắt buộc và độ dài không quá 50 ký tự.';
        }

        if (
            empty($data['email'])
            || strlen($data['email']) > 100
            || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)
            || !empty($this->user->find('*', 'email = :email AND user_id != :id', ['email' => $data['email'], 'id' => $id]))
        ) {
            $_SESSION['errors']['email'] = 'Trường email bắt buộc, độ dài không quá 100 ký tự và không được trùng';
        }

        if (empty($data['password']) || strlen($data['password']) < 6 || strlen($data['password']) > 30) {
            $_SESSION['errors']['password'] = 'Trường password bắt buộc, độ dài trong khoảng từ 6 đến 30 ký tự.';
        }

        if ($data['image']['size'] > 0) {

            if ($data['image']['size'] > 10 * 1024 * 1024) {
                $_SESSION['errors']['image_size'] = 'Trường image có dung lượng tối đa 2MB';
            }

            $fileType = $data['image']['type'];
            $allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($fileType, $allowedTypes)) {
                $_SESSION['errors']['image_type'] = 'Xin lỗi, chỉ chấp nhận các loại file JPG, JPEG, PNG, GIF.';
            }
        }

        if (!empty($_SESSION['errors'])) {
            throw new Exception('Dữ liệu lỗi!');
        }

        if ($data['image']['size'] > 0) {
            $data['image'] = upload_file('users', $data['image']);
        } else {
            $data['image'] = $user['image'];
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        $rowCount = $this->user->update($data, 'user_id = :id', ['id' => $id]);

        if ($rowCount > 0) {

            if (
                $_FILES['image']['size'] > 0
                && !empty($user['image'])
                && file_exists(PATH_ASSETS_UPLOADS . $user['image'])
            ) {
                unlink(PATH_ASSETS_UPLOADS . $user['image']);
            }

            $_SESSION['success'] = true;
            $_SESSION['msg'] = 'Thao tác thành công!';
        } else {
            throw new Exception('Thao tác KHÔNG thành công!');
        }
    } catch (\Throwable $th) {
        $_SESSION['success'] = false;
        $_SESSION['msg'] = $th->getMessage() . ' - Line: ' . $th->getLine();

        if ($th->getCode() == 99) {
            // header('Location: ' . BASE_URL . '&action=users-index');
            // exit();
        }
    }
}
    public function deletes()
    {
        try {

            if (!isset($_GET['id'])) {
                throw new \Exception('Thiếu tham số id ', 99);

            }
            $id = $_GET['id'];

            $users = $this->user->find('*', 'user_id = :id ', ['id' => $id]);

            // debug($users); 
            // // die ;
            // if(empty($users))  {
            //     throw new \Exception("User có Id = $id không tồn tại !") ;
            // }
            $rowCount = $this->user->delete('user_id = :id', ['id' => $id]);
            // debug($id); 
            // die ;
            // $userr = $this->user->delete('id > :id ');
            // $uerr = $this->user->deleteid($id) ;

            debug($rowCount);
            die;
            if ($rowCount > 0) {
                if (!empty($users['image']) && file_exists(PATH_UPLOAD . $users['image'])) {
                    unlink(PATH_UPLOAD . $users['image']);
                }
            } else {
                throw new \Exception('Xóa không thành công ! ');

            }
        } catch (\Throwable $th) {
            //throw $th;
            $_SESSION['success'] = false;
            $_SESSION['msg'] = $th->getMessage();

        }
        //    header('')
        // header()
        // header('Location: ' . BASE_URL . 'account.index');
    }



}