
<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
class Databaseconn{
private  $db;


public static function getdbconnection($dbhost,$dbname,$uname,$password){
$d= new static;
$d->db = new PDO("mysql:host=".$dbhost.";dbname=".$dbname, $uname, $password);
$d->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $d;


}

public  function fetchAllAS($tablename,$classname){


$query="SELECT * from $tablename";
  $prep = $this->db->prepare($query);
 $prep->execute();
  return $prep->fetchAll(PDO::FETCH_CLASS,$classname);

}

public  function lastid(){
  return $this->db->lastInsertId();
}


public  function fetchquery($classname,$quer,$array){


$query=$quer;
  $prep = $this->db->prepare($query);
 $prep->execute($array);
  return $prep->fetchAll(PDO::FETCH_CLASS,$classname);

}

public  function fetchobj($classname,$quer,$array){


$query=$quer;
  $prep = $this->db->prepare($query);
 $prep->execute($array);
  return $prep->fetchObject($classname);

}
public  function fetchqueryGen($quer,$array){


$query=$quer;
  $prep = $this->db->prepare($query);
 $prep->execute($array);
  return $prep->fetchAll(PDO::FETCH_CLASS);

}
public  function doquery($quer,$array){


$query=$quer;
  $prep = $this->db->prepare($query);
 $prep->execute($array);
 

}

}






