<?php


namespace database;
use database\Connection;
use PDO;
require_once "database/Connection.php";
/**
 * Created by PhpStorm.
 * User: kazafy
 * Date: 24/02/17
 * Time: 10:59 م
 */
class UserController
{

    function  login(User $user){
        $db = Connection::getConnection();
        $query = "SELECT * FROM users WHERE email =?";

        $statement = $db->prepare($query);

        $parameters = [ $user->getEmail() ];

        $statement->execute($parameters);
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            echo $row["password"]."<hr/>";

            echo password_hash($user->getPassword(),PASSWORD_DEFAULT)."<hr/>";

            if(password_verify($user->getPassword(),$row["password"])) {
                $user->setUsername($row['username']);
                $user->setType($row['type']);
                $user->setId($row['id']);
                return 1;
            }else{
                return -1;
            }
        }
        return 0;
    }

    function register($user){
        /////////////////////////////////

        $db = Connection::getConnection();
        $query = "INSERT INTO users VALUES (null,?,?,?,?,?,null)";

        $statement = $db->prepare($query);
        $pass =password_hash($user->getPassword(),PASSWORD_DEFAULT);
        $parameters = [ $user->getUsername(),$user->getEmail(),$user->getPhone(),$pass,$user->getType()];

        $statement->execute($parameters);
        return 1;
    }

//    function userList(){
//            $db = Connection::getConnection();
//            $query = "SELECT * FROM users ";
//
//            $statement = $db->prepare($query);
//
//            $statement->execute();
//            $users = $statement->fetchAll(PDO::FETCH_CLASS,'model\User');
//            return $users;
//
//    }

    function deleteUser($id){

        $db = Connection::getConnection();
        $query = 'DELETE FROM users  WHERE id = ?';
        $statement = $db->prepare($query);
        $statement->bindParam(1,$id,PDO::PARAM_INT);
        $statement->execute();
        return 1;
    }

    function updateUser($user){
        /////////////////////////////////

        $db = Connection::getConnection();
        $query = "UPDATE users set username=? , email=? , phone =? ,type=? WHERE id = ?";

        $statement = $db->prepare($query);
        $parameters = [ $user->getUsername(),$user->getEmail(),$user->getPhone(),$user->getType(),$user->getId()];

        $statement->execute($parameters);
        return 1;
    }

    function getUser($id){

        $db = Connection::getConnection();
        $query = 'SELECT * FROM users  WHERE id = ?';
        $statement = $db->prepare($query);
        $statement->bindParam(1,$id,PDO::PARAM_INT);
        $statement->execute([$id]);
        $user = $statement->fetchObject('model\User');
        return $user;

    }


}