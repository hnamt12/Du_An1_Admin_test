<?php 

namespace App\Controllers;
use App\Models\AccountModel;
use App\Models\BaseModel ;


class AccountController extends BaseController{
    
    protected $user ; 

    public function __construct(){
        $this->user = new AccountModel() ;

    }
    public function index(){
        // return $this->view('layouts.compoments.main_dashbord') ; 
        // $data = $this->user->select('*','parent_id> :id ',['id'=>1]) ; 
        // $data = $this->user->delete('category_id> :id ',['id'=>1]);
        // $data = $this->user->update(['name'=>'trang nguu 2 '],'category_id> :id',['id'=>2]) ; 
        // $data = $this->user->get2Top();
        // debug($data) ;         
        // $data = $this->user->insert(['username'=>'trang nguu 2 '  ],'users> :id',['id'=>1]) ; 
        $users= $this->user->select();
        // debug($users) ; 

        return $this->view('account.index',compact('users')) ; 
    }
    public function creat(){
        return $this->view('account.creat') ;
    }
//     public function store(Request $request)
//     {
//     $request->validate([
//         'title' => 'required|string|max:255',
//         'author' => 'required|string|max:255',
//         'genre' => 'required|string|max:255',
//         'chapter_count' => 'required|integer',
//     ]);

//     //thầy chữa 
//     // $data = $request->all() 
//     // Comic::query()->create()

//     Comic::create($request->all());

//     return redirect()->route('comics.index')
//     ->with('success', 'Truyện tranh đã được thêm!');
// }


    /**
     * Display the specified resource.
     */
    public function show()
    {
        try {
            
            if(!isset($_GET['id'])){
                throw new \Exception('Thiếu tham số id ',99) ;

            }
            $id = $_GET['id'] ; 
          
            $user = $this->user->find('*','user-id = :id ',['id'=>$id]) ; 
            //   debug( $users); 
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
        return $this->view('account.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
{
    try {
            
        if(!isset($_GET['id'])){
            throw new \Exception('Thiếu tham số id ',99) ;

        }
        $id = $_GET['id'] ; 
      
        $users = $this->user->find('*','user-id = :id ',['id'=>$id]) ; 
         
        // if(empty($users))  {
        //     throw new \Exception("User có Id = $id không tồn tại !") ;
        // }
        
    } catch (\Throwable $th) {
        //throw $th;
            // $_SESSION['success'] = false ; 
            // $_SESSION['msg'] = $th->getMessage();

    }   


    return $this->view('account.edit', compact('users'));
}

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, Comic $comic)
// {
//     $request->validate([
//         'title' => 'required|string|max:255',
//         'author' => 'required|string|max:255',
//         'genre' => 'required|string|max:255',
//         'chapter_count' => 'required|integer',
//     ]);
//     // $comic = Comic::findOrFail($comic) ; 


//     $comic->update($request->all());

//     return redirect()->route('comics.index')
//     ->with('success', 'Truyện tranh đã được cập nhật!');
// }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(Comic $comic)
// {
//     $comi    c->delete();
//     return redirect()->route('comics.index')
//     ->with('success', 'Truyện tranh đã được xóa!');
// }
    public function deletes(){
        try {
            
            if(!isset($_GET['id'])){
                throw new \Exception('Thiếu tham số id ',99) ;

            }
            $id = $_GET['id'] ; 
         
            $users = $this->user->find('*','id = :id ',['id'=>$id]) ; 
            
            // debug($users); 
            // // die ;
            // if(empty($users))  {
            //     throw new \Exception("User có Id = $id không tồn tại !") ;
            // }
            $rowCount = $this->user->delete('id = :id',['id' => $id]) ; 
            // debug($id); 
            // die ;
            // $userr = $this->user->delete('id > :id ');
            // $uerr = $this->user->deleteid($id) ;
           
            debug($rowCount); 
            die ;
            if($rowCount>0){
                if(!empty($users['image']) && file_exists(PATH_UPLOAD .$users['image'])){
                    unlink(PATH_UPLOAD.$users['image']) ;
                }
            }else{
                throw new \Exception('Xóa không thành công ! ') ;

            }
        } catch (\Throwable $th) {
            //throw $th;
                $_SESSION['success'] = false ; 
                $_SESSION['msg'] = $th->getMessage();

        }
    //    header('')
        // header()
        // header('Location: ' . BASE_URL . 'account.index');
    }  



}