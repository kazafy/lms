<?php
class Category{
	private $id  ;
	private $name  ;
    private $description;
	private $creation_date;
	private $creatorid;


	public function __construct($name="",$description="",$creatorid="") {
		$this->name=$name;
		$this->creatorid=$creatorid;
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
	public static function FetchCategory(){
		global $page;
		$db= $page["db"];
		return $db->fetchAllAS('Category','Category');
		
	}
	public  function Fetchuserinto($id){
		
	}
	public  function insert(){
	
		
	}
	
    	public  function update(){
	
		
	}
    	public  function delete(){
	
		
	}
    public  static function insertCategory(){
	
		
	}
     public  static function updateCategory(){
	
		
	}
     public  static function deleteCategory(){
	
		
	}
	

	
}

