<?php
class Course{
	private $id  ;
	private $name  ;
    private $description;
	private $creation_date;
	private $creatorid;
    private $categoryid;


	public function __construct($name="",$description="",$creatorid="",$categoryid="") {
		$this->name=$name;
		$this->creatorid=$creatorid;
        $this->categoryid=$categoryid;
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
	public static function FetchCourse(){
		global $page;
		$db= $page["db"];
		return $db->fetchAllAS('Course','Course');
		
	}
	public  function Fetchuserinto($id){
		
	}
	public  function insert(){
	
		
	}
	
    	public  function update(){
	
		
	}
    	public  function delete(){
	
		
	}
    public  static function insertCourse(){
	
		
	}
     public  static function updateCourse(){
	
		
	}
     public  static function deleteCourse(){
	
		
	}
	

	
}

