<?php
/**
 * Created by PhpStorm.
 * User: kazafy
 * Date: 27/02/17
 * Time: 09:17 ص
 */

namespace database;

require_once "database/Connection.php";
use database\Connection;
use PDO;
use model\Post;

require_once 'model/Post.php';

class PostController

{
    function getPostsList(){

        $db = Connection::getConnection();
        $query = "SELECT * FROM posts ";

        $statement = $db->prepare($query);

        $statement->execute();
        $posts = $statement->fetchAll(PDO::FETCH_CLASS,'model\Post');
        return $posts;

    }

    function getPost($id){

        $db = Connection::getConnection();
        $query = "SELECT * FROM posts WHERE id = ?";

        $statement = $db->prepare($query);
        $statement->execute([$id]);
        $posts = $statement->fetchObject('model\Post');
        return $posts;

    }
    function savePost($post){
        $db = Connection::getConnection();
        $query = "INSERT INTO posts VALUES (null,?,?,?,?,now(),?)";

        $statement = $db->prepare($query);
        $statement->bindParam(1,$post->getHeader() , PDO::PARAM_STR);
        $statement->bindParam(2,$post->getKeywords() , PDO::PARAM_STR);
        $statement->bindParam(3,$post->getText() , PDO::PARAM_STR);
        $statement->bindParam(4,$post->getImg() , PDO::PARAM_STR);
        $statement->bindParam(5,intval($post->getUserId()),PDO::PARAM_INT);
        $statement->execute();
        return 1;
    }

    function updatePost($post){

        $db = Connection::getConnection();
        $query = "update posts set header=?, keywords=? , text =? , time =now()  WHERE id =?";

        $statement = $db->prepare($query);
        $statement->bindParam(1,$post->getHeader() , PDO::PARAM_STR);
        $statement->bindParam(2,$post->getKeywords() , PDO::PARAM_STR);
        $statement->bindParam(3,$post->getText() , PDO::PARAM_STR);
        $statement->bindParam(4,$post->getId(),PDO::PARAM_INT);

        $statement->execute();
        return 1;
    }

    function deletePost($id){

        $db = Connection::getConnection();
        $query = "DELETE FROM posts WHERE id = ?";

        $statement = $db->prepare($query);
        $statement->execute([$id]);
        return 1;

    }


}