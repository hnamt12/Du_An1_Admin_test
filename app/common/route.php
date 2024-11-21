<?php
use Phroute\Phroute\RouteCollector;
use App\Controllers\BaseController;


$url = !isset($_GET['url']) ? "/" : $_GET['url'];

$router = new RouteCollector();

//bắt đầu định nghĩa ra các đường dẫn
// $router->get('/', function(){
//     return $this->base->view('index');
// });
$router->get('/',[App\Controllers\HomeController::class,"index"]) ;
$router->get('account.index',[App\Controllers\AccountController::class,"index"]) ;

$router->get('account.creat',[App\Controllers\AccountController::class,"create"]) ;
$router->post('account.store',[App\Controllers\AccountController::class,"store"]) ;


$router->get('account.upload',[App\Controllers\AccountController::class,"createload"]) ;
$router->post('account.storeload',[App\Controllers\AccountController::class,"storeload"]) ;


$router->get('account.show',[App\Controllers\AccountController::class,"show"]) ;

$router->get('account.edit',[App\Controllers\AccountController::class,"edit"]) ;
$router->post('account.update',[App\Controllers\AccountController::class,"update"]) ;


$router->get('account.destroy',[App\Controllers\AccountController::class,"deletes"]) ;
// $router->get('/account/{id}/edit', [App\Controllers\AccountController::class, 'edit']);
// $router->get('/account/{id}', [App\Controllers\AccountController::class, 'show']);





# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

// Print out the value returned from the dispatched function
echo $response;


?>