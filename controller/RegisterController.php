<?php
/**
 * Created by PhpStorm.
 * User: kazafy
 * Date: 25/02/17
 * Time: 11:24 م
 */

namespace controller;
use database\UserController;
//use model\User;

//require_once 'model/User.php';
require_once 'database/UserController.php';
require_once 'classes/User.php';

class RegisterController
{
    function registerHandler()
    {


        if (isset($_REQUEST["submit"])) {
            $passwordErr = $emailErr = $usernameErr="";

            $valide = true;
            $user = new \User();
            $user->email=$_REQUEST['email'];
            $user->password=$_REQUEST['password'];
            $user->name=$_REQUEST['username'];
            $user->state = 1;
            if (empty($user->name)) {
                $valide = false;
                $usernameErr = "username required";
            }
            if (empty($user->email)) {
                $valide = false;
                $emailErr = "Email required";
            }
            if (empty($user->password)) {
                $valide = false;
                $passwordErr = "password required";
            }




            if ($valide) {

                $userController = new UserController();

//                $user->type=0;

                $user->password =password_hash($user->password,PASSWORD_DEFAULT);
                try {
                    $result = $user->insert();
                    $result = 1;
                }catch (\Exception $ex){
                    $result = -1;
                }
                switch ($result) {
                    case 1:
                        session_start();
                        $_SESSION["user"] = $user;

                        $blocks = \Category::Fetchall();
                        include "view/home.php";
                        exit();
                        break;
                    case -1:
                        $passwordErr = "email already exist";
                        include "view/register.php";
                        exit();
                        break;
                }

            }
            else{
                include "view/register.php";
                exit();
            }

        } // if first loade
        else {
            include "view/register.php";
        }


    }
    }