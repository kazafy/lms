<?php
/**
 * Created by PhpStorm.
 * User: kazafy
 * Date: 26/02/17
 * Time: 11:16 م
 */

namespace controller;


use database\UserController;
use model\User;

require_once 'model/User.php';
require_once 'database/UserController.php';

class AdminController
{

    function showUsers(){
        $userController =new UserController();
        $users = $userController->userList();
        $action = 1;
        include "view/admin.php";
    }
    function deleteUser($id){
        $user = $_SESSION['user'];
        $userController =new UserController();
        if($id != 1)
            $userController->deleteUser($id);

        $users = $userController->userList();
        $action = 1;
        include "view/admin.php";

    }

    function updateUser($id){
        $user = $_SESSION['user'];
        $userController =new UserController();

        if(isset($_REQUEST['saveid'])) {
            $user = new User();
            $user->setId($_REQUEST['saveid']);
            $user->setUsername($_REQUEST['username']);
            $user->setEmail($_REQUEST['email']);
            $user->setPhone($_REQUEST['phone']);
            $user->setType($_REQUEST['type']);
            $userController->updateUser($user);
            $users = $userController->userList();
            include "view/admin.php";
            exit();
        }

        $users = $userController->userList();
        if($id != 1) {
            $action = 2;
            $updateId = $id;
        }
        include "view/admin.php";
    }


}