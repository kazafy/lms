
<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
/*

 _________________________________________
/ Attention Please ! , This query builder \
\ is NOT YET COMPLETED                    /
 -----------------------------------------
    \                                  ___-------___
     \                             _-~~             ~~-_
      \                         _-~                    /~-_
             /^\__/^\         /~  \                   /    \
           /|  O|| O|        /      \_______________/        \
          | |___||__|      /       /                \          \
          |          \    /      /                    \          \
          |   (_______) /______/                        \_________ \
          |         / /         \                      /            \
           \         \^\\         \                  /               \     /
             \         ||           \______________/      _-_       //\__//
               \       ||------_-~~-_ ------------- \ --/~   ~\    || __/
                 ~-----||====/~     |==================|       |/~~~~~
                  (_(__/  ./     /                    \_\      \.
                         (_(___/                         \_____)_)



*/
//select [selected]                                                           //done , Tested
//from [table(s)]                                                            ////In progress , later
//JOIN [table],(tables)                                                      ////done , Tested
//ON      [cond](and|or)[cond]                                              ////done , Tested
//where [cond](and|or)[cond]                //cond => "a = , < , > ,>=,<= " ////done , Tested
//groupby [thing(s)]                                                        ////done , Tested
//having [cond] (and|or) [cond]                                            //// done , Tested
//orderby [thing(s)]                                                       ////done , Tested

//insert into tablename('value1','value2','value3');
//u



class DynamicQueryBuilder{
private $wherecondition="";
private $joinstatement="";
private $onstatement="";
private $whereclauses="";
private $selectclause="";
private $groupclause="";
private $orderclause="";
private $havingclause="";
private $setclause=[];
private $valuesclause=[];
private $actualvalsclause=[];
private $table;
private $map=[];
public function __construct($table){
        $this->table=$table;
        $this->initall();
 }
private function initall(){

        $this->wherecondition="";
        $this->joinstatement="";
        $this->onstatement="";
        $this->whereclauses="";
        $this->groupclause="";
        $this->orderclause="";
        $this->havingclause="";
        $this->map=[];
        private $valuesclause=[];
private $actualvalsclause=[];

}
private function where($part1,$part2,$args){

         $replacer=new Replacer("?");
        $matchoptionsfp=["or"=>" OR ","and"=>" AND ",""=>""];
        $matchoptionsp2=["eq"=>"? = ?","lt"=>"? < ?"
        ,"gt"=>"? > ?","gte"=>"? >= ?",
        "ne"=>"? != ?","lte"=>"? <= ?","b"=>"? Between ? AND ?"
        ,"i"=>"? IN (?)"];
        $createdqwpart="";
        $createdqwpart.=$matchoptionsfp[$part1];
        $generatedp2=$replacer->replace($matchoptionsp2[$part2],$args,1);
        $generator=new Generator($args[0],":");
        $futargs=$args;
        array_splice($futargs,0,1);
        $allmyargs=$generator(count($futargs));
       $generatedp2=$replacer->replace(  $generatedp2, $allmyargs);
       $this->map=array_merge($this->map, array_combine( $allmyargs,$futargs));
      // //echo "MAP";
      // //var_dump( array_combine( $allmyargs,$futargs));
       
        $createdqwpart.=$generatedp2;
        $this->wherecondition.=  $createdqwpart;
        //echo   $this->wherecondition."\n";
        //var_dump ($this->map);

}
private function valuesd($part1,$part2){

       $generator=new Generator($part1,":");
       $allmyargs=$generator(1);
       $valuesclause[]=$part1;
       $actualvalsclause[]=$allmyargs[0];
}
private function valuesg($part1){
     $keys=array_keys($part1);
     foreach ($part1 as $key=> $value){
        $this->valuesd($key,$value);
     }
       
}
private function values($arg){

        if(count($arg)==1)
             $this->valuesd($arg[0],$arg[1]);
        else
             $this->valuesg($arg);    
     

}
       

private function set($part1,$part2){

         $replacer=new Replacer("?");
       
        $matchoptionsp2="? = ?";
        $createdqwpart="";
       
        $generatedp2=$replacer->replace($matchoptionsp2,[$part1],1);
        $generator=new Generator($part1,":");
       
        $allmyargs=$generator(1);
       $generatedp2=$replacer->replace(  $generatedp2, $allmyargs);
       $this->map=array_merge($this->map, array_combine( $allmyargs,[$part1]));
      // //echo "MAP";
      // //var_dump( array_combine( $allmyargs,$futargs));
       
        $createdqwpart.=$generatedp2;
        $this->setclause[]=  $createdqwpart;
        //echo   $this->wherecondition."\n";
        //var_dump ($this->map);

}
private function on($part1,$part2,$args){

         $replacer=new Replacer("?");
        $matchoptionsfp=["or"=>" OR ","and"=>" AND ",""=>""];
        $matchoptionsp2=["eq"=>"? = ?","lt"=>"? < ?"
        ,"gt"=>"? > ?","gte"=>"? >= ?",
        "ne"=>"? != ?","lte"=>"? <= ?","b"=>"? Between ? AND ?"
        ,"i"=>"? IN (?)"];
        $createdqwpart="";
        $createdqwpart.=$matchoptionsfp[$part1];
        $generatedp2=$replacer->replace($matchoptionsp2[$part2],$args);
      
      // //echo "MAP";
      // //var_dump( array_combine( $allmyargs,$futargs));
      // //var_dump ($this->map);
        $createdqwpart.=$generatedp2;
        $this->onstatement.=  $createdqwpart;
        ////echo  $createdqwpart;
           //echo   $this->onstatement."\n";
        //var_dump ($this->map);

}
private function join($part1,$args)
{
   

  
        $matchoptionsfp=["and"=>" , ",""=>""];
        $createdqwpart="";
        $createdqwpart.=$matchoptionsfp[$part1];
     $createdqwpart.= implode(",",$args);
       
        $this->joinstatement .=$createdqwpart;
        //echo   $this->joinstatement;



}
private function select($args){
        if(count($args)>0)
        $this->selectclause.=implode(",",$args);
        else if(strlen($this->selectclause)==0)
        $this->selectclause="*";
        //echo  $this->selectclause;
}
private function order($args){
        $this->orderclause.=implode(",",$args);
           //echo  $this->orderclause;
}
private function group($args){
        $this->groupclause.=implode(",",$args);
           //echo  $this->groupclause;
}
private function having($part1,$part2,$args){

         $replacer=new Replacer("?");
        $matchoptionsfp=["or"=>" OR ","and"=>" AND ",""=>""];
        $matchoptionsp2=["eq"=>"? = ?","lt"=>"? < ?"
        ,"gt"=>"? > ?","gte"=>"? >= ?",
        "ne"=>"? < ?","lte"=>"? < ?","b"=>"? Between ? AND ?"
        ,"i"=>"? IN (?)"];
        $createdqwpart="";
        $createdqwpart.=$matchoptionsfp[$part1];
        $generatedp2=$replacer->replace($matchoptionsp2[$part2],$args,1);
        $generator=new Generator($args[0],":");
        $futargs=$args;
        array_splice($futargs,0,1);
        $allmyargs=$generator(count($futargs));
       $generatedp2=$replacer->replace(  $generatedp2, $allmyargs);
       $this->map=array_merge($this->map, array_combine( $allmyargs,$futargs));
      // //echo "MAP";
      // //var_dump( array_combine( $allmyargs,$futargs));
      // //var_dump ($this->map);
        $createdqwpart.=$generatedp2;
        $this->havingclause.=  $createdqwpart;
        ////echo  $createdqwpart;
                //echo   $this->havingclause."\n";
        //var_dump ($this->map);

}



 public function __call($name, $args) {
        $matches=[];
        //(and|or|)where(eq|lt|gt|lte|gte|)
        if(preg_match("/^(and|or|)where(eq|lt|gt|lte|ne|gte|b|i|a)$/" ,$name, $matches ))
        {
                $this->where($matches[1],$matches[2],$args);
        }
        else if(preg_match("/^(and|)join$/" ,$name, $matches ))
        {
                $this->join($matches[1],$args);
        }
        else if(preg_match("/^(and|or|)on(eq|lt|gt|lte|ne|gte|b|i|a)$/" ,$name, $matches ))
        {
                $this->on($matches[1],$matches[2],$args);
        }
        else if(preg_match("/^get$/" ,$name, $matches ))
        {
                $this->select($args);
        }
        else if(preg_match("/^ord$/" ,$name, $matches ))
        {
                $this->order($args);
        }
        else if(preg_match("/^grpby$/" ,$name, $matches ))
        {
                 $this->group($args);
        }
        else if(preg_match("/^vals$/" ,$name, $matches ))
        {
                $this->values($args);
        }
        else{
            
            
            throw new Exception('No Such function '.$name.' in class '. get_class($this));
            



        }
        
        return $this;
        
 
 }



 function update(){

$replacer=new Replacer("?");
$strreplaced="Update ? values(?)";
$query=$replacer->replace($strreplaced,[$this->table,implode(",",$this->valuesclause),implode(",",$this->actualvalsclause)]);
echo $query;
$this->initall();
}
 function select(){


$replacer=new Replacer("?");
$strreplaced="select from ? values(?)";
$query=$replacer->replace($strreplaced,[$this->table,implode(",",$this->valuesclause),implode(",",$this->actualvalsclause)]);
echo $query;
$this->initall();

}
function insert(){

$replacer=new Replacer("?");
$strreplaced="insert into ?(?) values(?)";
$query=$replacer->replace($strreplaced,[$this->table,implode(",",$this->valuesclause),implode(",",$this->actualvalsclause)]);
echo $query;
$this->initall();

}
 function delete(){


$replacer=new Replacer("?");
$strreplaced="Delete from ? where ?";
$query=$replacer->replace($strreplaced,[$this->table,$this->whereclauses]);
echo $query;
$this->initall();

}



  public function __get($name) {
      $matches=[];
     if(preg_match("/^up$/" ,$name, $matches ))
        {
        $this->update();
        }
         else if(preg_match("/^sel$/" ,$name, $matches ))
        {
        $this->select();
        }
         else if(preg_match("/^del$/" ,$name, $matches ))
        {
        $this->delete();
        }
        else if(preg_match("/^ins$/" ,$name, $matches ))
        {
        $this->insert();
        }
        else{


              throw new Exception('No Such operation '.$name.' in class '. get_class($this));


        }
  }


    public static function __callStatic($name, $args)
    {
        // Note: value of $name is case sensitive.
        //echo "Calling static method '$name' "
             . implode(', ', $args). "\n";
    }
}

