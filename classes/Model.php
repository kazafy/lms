<?php
class Model{
private $properties=[];
private static $db;
private $tname;
private $pk;

	public function __construct() {

	    $dbhost="localhost";
        $dbname="Project";
        $uname="root";
        $password="";
        
        $me=new Reflectionclass($this);
        $allprop=$me->getDefaultProperties();
        $this->tname= $allprop["tablename"];
        $this->pk= $allprop["id"];
        self::$db=new PDO("mysql:host=".$dbhost.";dbname=".$dbname, $uname, $password);
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = self::$db->prepare("DESCRIBE {$this->tname}");
        $q->execute();

        $table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
        foreach($table_fields as $params)
        $this->properties[$params]=null;
        
      
    
	}
	public function __get($property) {
		if (array_key_exists ($property ,$this->properties)) {
			return $this->properties[$property];
		}
	}
	public function __set($property, $value) {
		if(array_key_exists ($property ,$this->properties)) {
		$this->properties[$property] = $value;
		}
		
		return $this;
	}
	public static function Fetchall(){
     
		  $me=new Reflectionclass(new static);
        $allprop=$me->getDefaultProperties();
       // var_dump($allprop);
        $tname= $allprop["tablename"];
        $pk= $allprop["id"];
     $query="SELECT * from $tname";
  $prep = self::$db->prepare($query);
 $prep->execute();
   $all=$prep->fetchAll(PDO::FETCH_ASSOC);
   $new=[];
   foreach ($all as $row ){
    $me=new static;
    foreach ($me->properties as $key=>$value)
    {
        $me->properties[$key]=$row[$key];
    }
    $new[]=$me;
   }
   return $new;
}
	
	public  function Fetchinto($id){
         $query="SELECT * from $tname";
        $prep = self::$db->prepare($query);
        $prep->execute();
        $all=$prep->fetchAll(PDO::FETCH_ASSOC);
        foreach ($me->properties as $key=>$value)
        {
             $me->properties[$key]=$row[$key];
        }
        $query=$quer;
        $prep = $this->db->prepare($query);
        $prep->execute($array);
        return $prep->fetchAll(PDO::FETCH_CLASS,$classname);

    
    
    
    }
    
	public  function insert(){	
	
     $setstat=[];
        $exec=[];
        $count=0;
         $vals = array_fill(0,count($this->properties), '?');
        foreach ($this->properties as $key=>$value)
        {
        $setstat[]=" $key ";

         isset($this->properties[$key])?$exec[]=$value:$vals[$count]="DEFAULT";
         $count++;
        }
       
        $setstat=implode(",",$setstat);
        $vals=implode(",",$vals);
        $query="INSERT INTO {$this->tname}($setstat) values ($vals) ";
        echo $query;
        $prep = self::$db->prepare($query);
       if( $prep->execute($exec)>0)
       $this->properties[$this->pk]=self::$db->lastInsertId();;
    
    
    
    }
    public  function update(){	

        $setstat=[];
        $exec=[];
        foreach ($this->properties as $key=>$value)
        {
        if( isset($this->properties[$key])){
           $setstat[]=" $key = ? ";
            $exec[]=$value;
           }
        }
        $setstat=implode(",",$setstat);
        $exec[]=$this->properties[$this->pk];
        $query="UPDATE {$this->tname} SET $setstat WHERE {$this->pk}=?";
            echo $query;
        $prep = self::$db->prepare($query);
        $prep->execute($exec);
	}

    public  function delete(){	
     $query="DELETE FROM {$this->tname} WHERE {$this->pk}=?";
     echo $query;
  $prep = self::$db->prepare($query);
  $prep->execute([$this->properties[$this->pk]]);	
    }

  /*
    public  static function insert(){
	}
     public  static function update(){
	}
     public  static function delete(){
	}
*/

	
}

