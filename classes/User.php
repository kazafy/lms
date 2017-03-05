<?php
class User{
private $id  ; 
private $name  ;   
private $email  ; 
private $password  ;   
private $creation_date;   
private $state;      
private $banstart ;
private $banend; 
public function __construct($name="",$email="",$password="") {
      $this->name=$name;
      $this->email=$email;
      $this->password=$password;
      $this->state=1;
   }
  public function __get($property) {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
  }
    public function __set($property, $value) {
    if (property_exists($this, $property)) {
      $this->$property = $value;
    }

    return $this;
  }
  public static function Fetchusers(){
global $page;
$db= $page["db"];
return $db->fetchAllAS('User','User');
      
  }
public  function Fetchuserintome($uid){
//global $page;
//$db= $page["db"];
//$altuser= $db->fetchquery('Comments',"SELECT * from User where id = :id ",array(":id"=>$uid));  

  }
      public  function insertthisusermin(){
        global $page;
        $db= $page["db"];
        

        $db->doquery("insert into User( name,email,password,state) values (:name,:email,:password,:state)",array(":name"=>$this->name,":email"=>$this->email,":password"=>$this->password,":state"=>$this->state,));
$this->id=$db->lastid();
      
  }

 
  }

