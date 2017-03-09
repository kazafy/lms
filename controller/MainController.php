<?php
/**
 * Created by PhpStorm.
 * User: kazafy
 * Date: 26/02/17
 * Time: 06:25 ص
 */

namespace controller;

use database\PostController;
use database\UserController;
use model\Post;
use model\User;
//use classes\Category;
require_once 'classes/Category.php';
require_once 'classes/User.php';

//require_once 'model/User.php';
require_once 'database/PostController.php';


class MainController
{

    function mainHandler(){

        $cat = new \Category();
        $catList = \Category::Fetchall();

        session_start();
        $user = (isset($_SESSION['user']))?$_SESSION['user']:null;
        if($user == null){
            session_destroy();
        }

        $postController = new PostController();
        $blocks = \Category::Fetchall();
        include "view/home.php";

    }

    function showBlocks($blockName ,$className, $childclassName=null){

        $ref = new \ReflectionClass($className);
        $blok= $ref->newInstance();

        $temp = $className::fetchname($blockName)[0];
        $funprep="fetch".$className."id";
        $blocks = $childclassName::$funprep($temp->id);
        exit();



    }


    function deleteBlock($table,$id){
        $ref = new \ReflectionClass($table);
        $blok= $ref->newInstance();
        $blok->id=$id;
        $blok->delete();
    }


    function postPreviewHandeler($id){
        session_start();
        $user = (isset($_SESSION['user']))?$_SESSION['user']:null;
        if($user == null){
            session_destroy();
        }
        $postController = new PostController();
        $post = $postController->getPost($id);
        $userController = new UserController();
        $writer = $userController->getUser($post->getId());
        include "view/post.php";
        exit();

    }



    function deletePost($id){
        $user = $_SESSION['user'];
        $postController = new PostController();
        $post = $postController->getPost($id);

        if (!empty($post) && $user->getType() == 0 || $post->getUserId() == $user->getId()){

            $postController->deletePost($id);
        }else{
            echo  " not allowed ";
        }
        header("Location: http://localhost/lms/home/");
        exit();


    }

    function updatePost($id){

        $user = $_SESSION['user'];
        $postController = new PostController();
        $post = $postController->getPost($id);

        if(isset($_REQUEST['submit'])) {

            $headerErr = $keywordsErr = $textErr = $imgErr = "";
            $valide = true;

            $post = new Post();
            $post->setId($id);

            $post->setHeader($_REQUEST['header']);
            $post->setKeywords($_REQUEST['keywords']);
            $post->setText($_REQUEST['text']);
            $post->setUserId(3);


        if (empty($post->getHeader())) {
            $valide = false;
            $headerErr = "header required";
        }

        if (empty($post->getKeywords())) {
            $valide = false;
            $keywordsErr = "keywords required";
        }

        if (empty($post->getText())) {
            $valide = false;
            $textErr = "text required";
        }

        if ($valide){

            $postController = new PostController();
            if($postController->updatePost($post)){
                header("Location: http://localhost/lms/home/");
                exit();
            };

        }
        }
        include "view/updatepost.php";
        exit();



}

    function addPost(){
        $user = $_SESSION['user'];

        if(isset($_REQUEST['submit'])) {

            $headerErr = $keywordsErr = $textErr= $imgErr="" ;
            $valide = true;

            $post = new Post();
            $post->setHeader($_REQUEST['header']);
            $post->setKeywords($_REQUEST['keywords']);
            $post->setText($_REQUEST['text']);
            $post->setUserId(3);

            if(isset($_FILES['image'])){
                $errors= array();
                $file_name = $_FILES['image']['name'];
                $file_size =$_FILES['image']['size'];
                $file_tmp =$_FILES['image']['tmp_name'];
                $file_type=$_FILES['image']['type'];
                $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

                $expensions= array("jpeg","jpg","png");

                if(in_array($file_ext,$expensions)=== false){
                    $errors[]="extension not allowed, please choose a JPEG or PNG file.";
                }

                if($file_size > 2097152){
                    $errors[]='File size must be excately 2 MB';
                }

                if(empty($errors)==true){
                    move_uploaded_file($file_tmp,"uploads/".$file_name);
                    $post->setImg("/lms/uploads/".$file_name);
                }else{
                    $imgErr = " cant upload the image !";
                    $valide = false;
                }
            }
            if (empty($post->getHeader())) {
                $valide = false;
                $headerErr = "header required";
            }

            if (empty($post->getKeywords())) {
                $valide = false;
                $keywordsErr = "keywords required";
            }

            if (empty($post->getText())) {
                $valide = false;
                $textErr = "text required";
            }

            if ($valide){

                $postController = new PostController();
                if($postController->savePost($post)){
                    header("Location: http://localhost/lms/home/");
                    exit();
                };

            }

        }

        include "view/addpost.php";
        exit();


    }



}