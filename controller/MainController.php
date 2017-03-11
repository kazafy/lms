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

require_once 'classes/Type.php';
require_once 'classes/Course.php';
require_once 'classes/Material.php';
require_once 'classes/User.php';
require_once 'classes/Comment.php';
//require_once 'model/User.php';
require_once 'database/PostController.php';


class MainController
{

    function mainHandler($level){

        $cat = new \Category();
        $catList = \Category::Fetchall();

        session_start();
        $user = (isset($_SESSION['user']))?$_SESSION['user']:null;
        if($user == null){
            session_destroy();
        }

        $blocks = \Category::Fetchall();

        include "view/home.php";

    }

    function showBlocks($blockName , $level){

        session_start();
        $user = (isset($_SESSION['user']))?$_SESSION['user']:null;
        if($user == null){
            session_destroy();
        }

        $cat = new \Category();
        $ty =new \Type();
        $cour = new \Course();

        $catogeries =\Category::Fetchall();
        $types = \Type::Fetchall();
        $courses = \Course::Fetchall();

        $blocls=['Category','Course','Material'];

        switch($level){
            case -1 :
                $cat = new \Category();
                $blocks = \Category::Fetchall();

                include "view/home.php";

             die;
            break;

            case 0 :
            case 1 :
                $className=$blocls[$level];
                $childclassName=$blocls[$level+1];
            //die;

                $ref = new \ReflectionClass($className);
                $blok= $ref->newInstance();

                $temp = $className::fetchname($blockName)[0];
                $funprep="fetch".$className."id";

                $blocks = $childclassName::$funprep($temp->id);
                $parentId=$temp->id;
                include "view/home.php";
                die;

                break;
            case 2 :
                    $className=$blocls[$level];
                    $childclassName=$blocls[$level+1];
                    $temp = $className::fetchname($blockName)[0];
                    echo $temp->path;
                    var_dump($_SERVER);

                      header("Location: $temp->path");
                      die;

            }



    }


    function deleteBlock($table,$id){
        $ref = new \ReflectionClass($table);
        $blok= $ref->newInstance();
        $blok->id=$id;
        $blok->delete();



    }
    function sendcomments($id) {
        
        $commentlist=\Comment::fetchmaterialid($id);
        $commentarray=array();

        foreach($commentlist as $mycomment)
        {
            $currcomment=[];
            $currcomment["id"]=$mycomment->id;
             $currcomment["creatorid"]=$mycomment->creatorid;
             $currcomment["body"]=$mycomment->body;
              $currcomment["creatorname"]=\User::fetchid($mycomment->creatorid)[0]->name;
            $commentarray[]=$currcomment;
        }

        echo json_encode($commentarray);
       exit();


    }
           function deletecomment($id) {
        session_start();
        $comment=new \Comment();
        $comment->id=$id;
       


        
        echo json_encode( $comment->delete());
       exit();


    }
        function submitcomments($id) {
        session_start();
        $comment=new \Comment();
        $comment->body=$_POST["body"];
        $comment->creatorid=$_SESSION['user']->id;
         $comment->materialid=$id;


        
        echo json_encode($comment->insert());
       exit();


    }
    function addBlock($level) {


        $user = (isset($_SESSION['user']))?$_SESSION['user']:null;

        switch ($level){
            case -1:
                echo json_encode($this->addCategory($user->id));
                break;
            case 0:
                echo json_encode($this->addCourse($user->id));
                break;
            case 1:
                echo json_encode($this->addMaterial($user->id));
                break;
            default:
                $error = "page not found";
                include ("view/errorpage.php");
                exit();
        }


        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();



    }
    private function  addCategory($creatorid){
        $category = new \Category();
        $category->name = $_REQUEST['name'];
        $category->description = $_REQUEST['desc'];
        $category->creatorid = $creatorid;
        $category->insert();
        $result =(object)["status"=>1];
        return $result;

    }
    private function  addCourse($creatorid){
        $course = new \Course();
        $course->name = $_REQUEST['name'];
        $course->description = $_REQUEST['desc'];
        $course->creatorid = $creatorid;
        $course->categoryid = $_REQUEST['category'];

        $course->insert();

        $coursetype = new \Course_Type();
        foreach($_REQUEST['types'] as $t){
            $coursetype->typeid=$t;
            $coursetype->courseid=$course->id;
            $coursetype->insert();
        }

    }
    private function  addMaterial($creatorid){
        $material = new \Material();
        $material->name = $_REQUEST['name'];
        $material->description = $_REQUEST['desc'];
        $material->creatorid = $creatorid;

        if(isset($_FILES['file'])){
            $errors= array();
            $file_name = $_FILES['file']['name'];
            $file_size =$_FILES['file']['size'];
            $file_tmp =$_FILES['file']['tmp_name'];
            $file_type=$_FILES['file']['type'];
            $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));

            $expensions= array("jpeg","jpg","png");

            if(in_array($file_ext,$expensions)=== false){
                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
            }

            if($file_size > 2097152){
                $errors[]='File size must be excately 2 MB';
            }

            if(empty($errors)==true){
                move_uploaded_file($file_tmp,"uploads/".$file_name);
                $material->path="/lms/uploads/".$file_name;
            }else{
                $imgErr = " cant upload the file !";
                $valide = false;
            }
        }


        $material->courseid = $_REQUEST['parent'];

        $material->typeid=1;
        $material->insert();
        $result =(object)["status"=>1];
        return $result;

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

/*
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
*/


}