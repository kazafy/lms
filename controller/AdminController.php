<?php
/**
 * Created by PhpStorm.
 * User: kazafy
 * Date: 26/02/17
 * Time: 11:16 م
 */

namespace controller;


use database\UserController;



require_once 'database/UserController.php';

class AdminController
{

    function showUsers(){
        $user = (isset($_SESSION['user']))?$_SESSION['user']:null;

//        $userController =new UserController();
//        $users = $userController->userList();
        $users  = \User::Fetchall();
        $category = new \Category();
        $course = new \Course();
        $material = new \Material();

        $categoryNumbers = count(\Category::Fetchall());
        $courseNumbers = count(\Course::Fetchall());
        $materialNumbers = count(\Material::Fetchall());

        $action = 1;
        $userNumbers = count($users);
        include "view/admin.php";
    }
    function deleteUser($id){
        $user = $_SESSION['user'];
        $userController =new UserController();
        if($id != 1) {
            $userTemp = new \User();
            $userTemp->Fetchinto($id);
            $userTemp->delete();
        }
        $users =\User::Fetchall();
        $category = new \Category();
        $course = new \Course();
        $material = new \Material();

        $categoryNumbers = count(\Category::Fetchall());
        $courseNumbers = count(\Course::Fetchall());
        $materialNumbers = count(\Material::Fetchall());
        $action = 1;
        $userNumbers = count($users);
        include "view/admin.php";

    }

    function updateUser($id){
        $user = $_SESSION['user'];

        $users =\User::Fetchall();
        $category = new \Category();
        $course = new \Course();
        $material = new \Material();

        $categoryNumbers = count(\Category::Fetchall());
        $courseNumbers = count(\Course::Fetchall());
        $materialNumbers = count(\Material::Fetchall());
        $userNumbers = count($users);

        if(isset($_REQUEST['saveid'])) {
            $user = new \User();
            $user->id=$_REQUEST['saveid'];
            $user->name=$_REQUEST['username'];
            $user->email=$_REQUEST['email'];
//            $user->setPhone=$_REQUEST['phone'];
            $user->type=$_REQUEST['type'];
            $user->update();
//            $userController->updateUser($user);
            include "view/admin.php";
            exit();
        }

        $users = \User::Fetchall();
        if($id != 1) {
            $action = 2;
            $updateId = $id;
        }
        include "view/admin.php";
    }


}