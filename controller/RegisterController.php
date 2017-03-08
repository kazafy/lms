<?php
/**
 * Created by PhpStorm.
 * User: kazafy
 * Date: 25/02/17
 * Time: 11:24 م
 */

namespace controller;
use database\UserController;
use model\User;

require_once 'model/User.php';
require_once 'database/UserController.php';

class RegisterController
{
    function registerHandler()
    {


        if (isset($_REQUEST["submit"])) {
            $passwordErr = $emailErr = $usernameErr="";
            $valide = true;
            $user = new User();
            $user->setEmail($_REQUEST['email']);
            $user->setPassword($_REQUEST['password']);
            $user->setUsername($_REQUEST['username']);

            if (empty($user->getEmail())) {
                $valide = false;
                $usernameErr = "username required";
            }

            if (empty($user->getEmail())) {
                $valide = false;
                $emailErr = "Email required";
            }

            if (empty($user->getPassword())) {
                $valide = false;
                $passwordErr = "password required";
            }

            if ($valide) {

                $userController = new UserController();

                $user->setType(1);
                $user->setPhone(rand(10000, 112000));

                $result = $userController->register($user);
                switch ($result) {
                    case 1:
                        session_start();
                        $_SESSION["user"] = $user;
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