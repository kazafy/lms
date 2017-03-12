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
            $user = \User::Fetch($request->creatorid);
            $request->creatorid = $user;
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


if(isset($_FILES['browsePicture'])){
            $errors= array();
            $file_name = $_FILES['browsePicture']['name'];
            $file_size =$_FILES['browsePicture']['size'];
            $file_tmp =$_FILES['browsePicture']['tmp_name'];
            $file_type=$_FILES['browsePicture']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['browsePicture']['name'])));


            if(in_array($file_ext,["jpeg","jpg","png",])=== false){

                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }

            if($file_size > 2097152){
                $errors[]='File size must be excately 2 MB';
            }
            $file_name= "ds".$file_ext;
            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"/uploads/".$file_name);
               $user->picture="/uploads/".$file_name;
            }else{
                $imgErr = " cant upload the file !";
                $valide = false;
            }




}
var_dump($_FILES);




            $user->update();
die();
           header("Location: /views/");
            exit();

        }

    }

}