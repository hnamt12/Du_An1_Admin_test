<?php 

namespace App\Controllers;
use App\Controllers\BaseController ; 
use App\Models\BaseModel ;
use App\Models\HomeModel;
// require_once "app/models/env.php" ; 

class HomeController extends BaseController{
    
    protected $home ; 

    public function __construct(){
        $this->home = new HomeModel() ;

    }
    public function index(){
        // return $this->view('layouts.compoments.main_dashbord') ; 
        return $this->view('index') ; 
    }
}
