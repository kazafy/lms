<?php




require_once("Model.php");

require_once("Course_Type.php");
require_once("Type.php");
class Course extends Model{

public $tablename="Course";
private $id="id";
public function insert_courses($carray){

foreach ($carray as $cid){
$ctype =new \Course_Type();
$ctype->courseid=parent::__get('id');
$ctype->typeid=$cid;
$ctype->insert();


}



}
public function get_types(){
$ctypelist=Course_Type::fetchcourseid(parent::__get('id'));
$ids=[];
foreach ($ctypelist as $cid){
$ids[]=$cid->typeid;


}
return $ids;

}

}