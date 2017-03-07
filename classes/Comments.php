<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
class Comment{
private $id  ; 
private $body;
private $creation_date;
private $creatorid;
 private $courseid  ;       

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
  public static function Fetchcomments(){
        global $page;
$db= $page["db"];
return $db->fetchAllAS('Posts','Comments');
      
  }

      public static function Fetchcommentuser($uid){
        global $page;
$db= $page["db"];
return $db->fetchquery('Comments',"SELECT * from Posts where uid = :uid ",array(":uid"=>$uid));
      
  }
        public static function Fetchcommentid($id){
        global $page;
$db= $page["db"];
return $db->fetchquery('Comments',"SELECT * from Posts where id = :id ",array(":id"=>$id));
      
  }
      public static function insertcomment($uid,$title,$body){
        global $page;
$db= $page["db"];
$db->doquery("insert into Posts( uid,title,body) values (:uid,:title,:body)",array(":uid"=>$uid,":title"=>$title,":body"=>$body));

      
  }

        public static function updatecomment($id,$title,$body){
        global $page;
$db= $page["db"];

$db->doquery("Update  Posts set title= :title , body= :body where id = :id ",array(":id"=>$id,":title"=>$title,":body"=>$body));

      
  }


          public static function deletecomment($id){
        global $page;
$db= $page["db"];

$db->doquery("delete from  Posts where id = :id ",array(":id"=>$id));

      
  }
  public  function insert(){



  }
    public  function update(){



  }
      public  function delete(){



  }


}


?>