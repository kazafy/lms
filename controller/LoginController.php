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

//          var_dump($_COOKIE);
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

            $userTemp = new \User();

            $userTemp->email=$_REQUEST['email'];
            $userTemp->password=$_REQUEST['password'];
            $rememberMe= (isset($_REQUEST['rememberme']));

            if (empty($userTemp->email)) {
                $valide = false;
                $emailErr = "Email required";
                include "view/login.php";
                exit();
            }
            if (empty($userTemp->password)) {
                $valide = false;
                $passwordErr = "password required";
                include "view/login.php";
                exit();
            }

            if ($valide) {

//                $userController = new UserController();
                $user = \User::fetchemail($userTemp->email)[0];
//                echo($userTemp->password);
//                echo password_hash($userTemp->password,PASSWORD_DEFAULT);
//                echo "<hr/>";
//                var_dump(password_verify($user->password,$userTemp->password));
//                echo "<hr/>";
//                echo $user->password;
//                echo "<hr/>";


                if(!empty($user) && password_verify($userTemp->password,$user->password)) {
                    session_start();
                    $_SESSION["user"] = $user;
                    if ($rememberMe) {
                        echo "cooke";
                        setcookie("user", serialize($user)); // 86400 = 1 day
//                        exit();
                    }
                    header("Location: http://localhost/lms/views/");
//                        include "view/home.php";
                    exit();
                }else{
                    $emailErr = "email not found";
                    include "view/login.php";
                    exit();
                }

            }

        } // if first loade
        else {
            include "view/login.php";
        }


    }
}
