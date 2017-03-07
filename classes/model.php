<?php


class Model{

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
	public static function Fetchall(){
		global $page;
		$db= $page["db"];
     
        return $db->fetchAllAS(get_class(new self),get_class(new self));
		
	}
	public  function Fetchinto($id){
		
	}
	public  function insert(){
	
		
	}
	
    	public  function update(){
	
		
	}
    	public  function delete(){
	
		
	}
    public  static function insert(){
	
		
	}
     public  static function update(){
	
		
	}
     public  static function delete(){
	
		
	}
	

	
}

