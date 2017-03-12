<?php
/**
 * Created by PhpStorm.
 * User: kazafy
 * Date: 24/02/17
 * Time: 11:05 ص
 */
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
require_once 'classes/Category.php';
require_once 'controller/LoginController.php';
require_once 'controller/RegisterController.php';
require_once 'controller/MainController.php';
require_once 'controller/AdminController.php';

function route($regex, $cb) {
    $regex = str_replace('/', '\/', $regex);
    $is_match = preg_match('/^' . ($regex) . '$/', $_SERVER['REQUEST_URI'], $matches, PREG_OFFSET_CAPTURE);
    if ($is_match) { $cb($matches); }
}

//route('/blog/api/(.*)', function($matches){
//    \controller\CountersConntroller::getUpdatedCounters($matches[1][0]);
//    exit();
//});

//echo  " lol ";

//route('/api/login', function($matches){
//    header("Access-Control-Allow-Origin:*");
//    header("Access-Control-Allow-Headers:origin,X-Request-With,Content-Type,Accept,");
//
////    $loginController = new \controller\LoginController();
////    $loginController->loginHandler();
//     $user = new \model\User();
//     $user->setUsername("kazafy");
//    $user->setId(1);
//    $user->setImg("ddd");
//    $user->setEmail("dd");
//    $user->setPassword("d");
//    $user->setPhone("58");
//    $user->setType(1);
////     echo $user;
//    echo json_encode($user);
//    exit;
//});


route('/api/add/(.*)', function($matches){
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers:origin,X-Request-With,Content-Type,Accept,");
    checkLogin();
    $mainController =new \controller\MainController();
    $mainController->addBlock($matches[1][0]);

    exit;
});
route('/api/update/(.*)', function($matches){
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers:origin,X-Request-With,Content-Type,Accept,");
    checkLogin();
    $mainController =new \controller\MainController();
    $mainController->addBlock($matches[1][0]);

    exit;
});


route('/api/comments/get/(.*)', function($matches){
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers:origin,X-Request-With,Content-Type,Accept,");
   // die();
    //checkLogin();
    $mainController =new \controller\MainController();
    $mainController->sendcomments($matches[1][0]);
    header("Location: /views/");
    exit;
});

route('/api/comments/submit/(.*)', function($matches){
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers:origin,X-Request-With,Content-Type,Accept,");
   // die();
    //checkLogin();
    $mainController =new \controller\MainController();
    $mainController->submitcomments($matches[1][0]);
    exit;
});

route('/api/requests/submit/(.*)', function($matches){
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers:origin,X-Request-With,Content-Type,Accept,");
   // die();
    //checkLogin();
    $mainController =new \controller\MainController();
    $mainController->submitrequests($matches[1][0]);
    exit;
});
route('/material/download/(.*)', function($matches){
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers:origin,X-Request-With,Content-Type,Accept,");
   // die();
    //checkLogin();
    $mainController =new \controller\MainController();
    $mainController->downloadmaterial($matches[1][0]);
    exit;
});

route('/api/comments/delete/(.*)', function($matches){
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Headers:origin,X-Request-With,Content-Type,Accept,");
   // die();
    //checkLogin();
    $mainController =new \controller\MainController();
    $mainController->deletecomment($matches[1][0]);
    exit;
});

route('/', function($matches){


    include "index.php";
});

route('/login/(.*)', function($matches){

    $loginController = new \controller\LoginController();
    $loginController->loginHandler();
    exit;
});

route('/register/(.*)', function($matches){
    $registerController = new \controller\RegisterController();
    $registerController->registerHandler();
    exit;
});


route('/profile/', function($matches){
    checkLogin();
    $adminController = new \controller\AdminController();
    $adminController->editUser();
    $user = $_SESSION['user'];
    include ("view/profile.php");
    exit;
});




route('/admin/user/list/', function($matches){
    checkAdmin();
    $adminController = new \controller\AdminController();
    $adminController->showUsers();
    exit;
});

route('/request/delete/(.*)', function($matches){
    checkAdmin();
    $adminController = new \controller\AdminController();
    $adminController->deleteRequest($matches[1][0]);

    exit;
});


route('/admin/user/delete/(.*)', function($matches){
    checkAdmin();
    checkNumber($matches[1][0]);
    $adminController = new \controller\AdminController();
    $adminController->deleteUser((int)$matches[1][0]);
    exit;
});
route('/admin/user/update/(.*)', function($matches){
    checkAdmin();
    checkNumber($matches[1][0]);
    $adminController = new \controller\AdminController();
    $adminController->updateUser((int)$matches[1][0]);
    exit;
});
route('/admin/post/delete/(.*)', function($matches){
    checkAdmin();
    checkNumber($matches[1][0]);
    $mainController =new \controller\MainController();
    $mainController->deletePost($matches[1][0]);

    exit;
});


route('/([^/]+)/delete/(.*)', function($matches){
//    checkLogin();
//    var_dump($matches[1][0]);
//    var_dump($matches[2][0]);
    $mainController =new \controller\MainController();
    $mainController->deleteBlock($matches[1][0],$matches[2][0]);
    exit;
});


route('/admin/post/add/', function($matches){
    checkLogin();
    $mainController =new \controller\MainController();
    $mainController->addPost();
    exit;
});

route('/admin/post/update/(.*)', function($matches){
    checkLogin();
    checkNumber($matches[1][0]);
    $mainController =new \controller\MainController();
    $mainController->updatePost($matches[1][0]);
    exit;
});
route('/admin/post/list/', function($matches){

});

route('/admin/post/(.*)', function($matches){
//    checkAuth();
    $mainController = new \controller\MainController();
    checkNumber($matches[1][0]);
    $mainController->postPreviewHandeler((int)$matches[1][0]);
    exit;
});

route("/views/([^/]*)(?:/){0,1}([^/]*)(?:/){0,1}([^/]*)(?:/){0,1}", function($matches){
    $var =null;
    $i=count($matches)-1;
    $wmchs=[];
    for(; $i>0 ; $i--){

        if(!empty($matches[$i][0]))
        {
            $var = $matches[$i][0];
            break;
        }
    }
$wmchs[]='views';
       for($j=1; ($j<count($matches))&&(!empty($matches[$j][0])) ; $j++)
          {   $wmchs[] = $matches[$j][0];
             

          }
    
    $mainController = new \controller\MainController();

    $mainController->showBlocks($var ,--$i, $wmchs);
    exit;
});

route('/views/', function($matches){

    $mainController = new \controller\MainController();
    $mainController->showBlocks("",-1);
    exit;
});


route('/admin/(.*)', function($matches){
    checkAdmin();
});


route('/home/(.*)', function($matches){
    $mainController = new \controller\MainController();
    $mainController->showBlocks("",-1);
    exit;
});


route('/error', function($matches){
    include "view/errorpage.php";

});



function checkAdmin(){
    session_start();
    if(!isset($_SESSION['user'])) {
        header("Location: /login/");
    }
    else{
        $user = $_SESSION['user'];
        if($user->type!=0){
            echo "you dont have permition";
            exit();
        }
    }
}

function checkLogin(){
    session_start();
    if(!isset($_SESSION['user'])) {
        header("Location: /login/");
    }
    else{
        $user = $_SESSION['user'];
    }
}

function checkNumber($number){

    if( ! is_numeric($number)){
        include "view/errorpage.php";
        exit();
    }
}


route('/logout/', function($matches){
    session_start();
    echo  "logout";
    $_SESSION["user"]=null;
    session_destroy();

    setcookie('user', null, -1, '/');
    unset($_COOKIE['user']);
    header("Location: /views/");
    exit;
});
?>