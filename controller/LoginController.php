<?php
/**
 * Created by PhpStorm.
 * User: kazafy
 * Date: 24/02/17
 * Time: 03:32 م
 */

namespace controller;


use database\UserController;


//require_once 'model/User.php';
require_once 'database/UserController.php';
require_once 'classes/User.php';

class LoginController
{

    function loginHandler()
    {

          var_dump($_COOKIE);
    //
    //        if(!empty($_COOKIE['user'])){
    //            $user =(unserialize($_COOKIE['user']));
    //            session_start();
    //            $_SESSION["user"] = $user;
    //            echo  " login";
    //            header("Location: http://localhost/lms/home/");
    ////                        include "view/home.php";
    //            exit();
    //
    //        }
        if (isset($_REQUEST["submit"])) {
            $passwordErr = $emailErr = "";
            $valide = true;

            $user = new \User();

            $user->email=$_REQUEST['email'];
            $user->password=$_REQUEST['password'];
            $rememberMe= (isset($_REQUEST['rememberme']));

            if (empty($user->email)) {
                $valide = false;
                $emailErr = "Email required";
                include "view/login.php";
                exit();
            }
            if (empty($user->password)) {
                $valide = false;
                $passwordErr = "password required";
                include "view/login.php";
                exit();
            }

            if ($valide) {

//                $userController = new UserController();
                $result = \User::fetchemail($user->email);
                switch ($result) {
                    case 1:
                        session_start();
                        $_SESSION["user"] = $user;
                        if($rememberMe){
                            echo "cooke";
                            setcookie("user", serialize($user)); // 86400 = 1 day
                            exit();
                        }
                        header("Location: http://localhost/lms/home/");
//                        include "view/home.php";
                        exit();
                        break;
                    case 0:
                        $emailErr = "email not found";
                        include "view/login.php";
                        exit();
                        break;
                    case -1:
                        $passwordErr = "password not correct";
                        include "view/login.php";
                        exit();
                        break;
                }

            }

        } // if first loade
        else {
            include "view/login.php";
        }


    }
}
