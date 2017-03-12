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

        $requests = \Request::Fetchall();
        foreach ($requests as $request){

            $user = new \User();
//            $request->user = \User::Fetch($request->creatorid);
            $user = \User::Fetch(53);
            $request->creatorid = $user;
            $request->creatorid->picture ="/uploads/k.jpg";
        }

        $action = 1;
        $userNumbers = count($users);
        include "view/admin.php";
    }

    function deleteRequest($id){
        $request = new \Request();
        $request = \Request::Fetch($id);
        $request->delete();

        header("Location: /admin/user/list/");

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

        $requests = \Request::Fetchall();
        foreach ($requests as $request){

            $user = new \User();
//            $request->user = \User::Fetch($request->creatorid);
            $user = \User::Fetch(53);
            $request->creatorid = $user;
            $request->creatorid->picture ="/uploads/k.jpg";
        }

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

        $requests = \Request::Fetchall();
        foreach ($requests as $request){

            $user = new \User();
//            $request->user = \User::Fetch($request->creatorid);
            $user = \User::Fetch(53);
            $request->creatorid = $user;
            $request->creatorid->picture ="/uploads/k.jpg";
        }


        $users = \User::Fetchall();



        if(isset($_REQUEST['saveid'])) {
            $user = new \User();
            $user->id=$_REQUEST['saveid'];
            $user->name=$_REQUEST['username'];
            $user->email=$_REQUEST['email'];
            $user->gender=$_REQUEST['gender'];
            $user->type=$_REQUEST['type'];
            $user->update();
            $users = \User::Fetchall();
            include "view/admin.php";
            exit();
        }

        if($id != 1) {
            $action = 2;
            $updateId = $id;
        }
        include "view/admin.php";
    }

    function editUser(){
        $user = $_SESSION['user'];

        if(isset($_REQUEST['edit'])) {
            $student = new \User();
            $user->name=$_REQUEST['studentName'];
            $user->email=$_REQUEST['studentEmail'];
            $user->gender=$_REQUEST['male'];
            $user->country=$_REQUEST['country'];
            $user->signature=$_REQUEST['studentSignature'];

            $user->update();

           header("Location: /home/");
            exit();

        }

    }

}