
<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
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
        $this->selectclause=implode(",",$args);
        else 
        $this->selectclause="*";
        //echo  $this->selectclause;
}
private function order($args){
        $this->orderclause=implode(",",$args);
           //echo  $this->orderclause;
}
private function group($args){
        $this->groupclause=implode(",",$args);
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
        else if(preg_match("/^order$/" ,$name, $matches ))
        {
        $this->order($args);
        }
        else if(preg_match("/^group$/" ,$name, $matches ))
        {
        $this->group($args);
        }
     
        else{
            
            
            throw new Exception('No Such function '.$name.' in class '. get_class($this));
            



        }
        
        return $this;
        
 
 }


$operations=[
"up"=> function(){
/*
update $






*/




},
"sel"=> function(){

//select [selected]                                                           //done , Testing X
//from [table(s)]                                                            ////In progress , later
//JOIN [table],(tables)                                                      ////done , Tested
//ON      [cond](and|or)[cond]                                              ////done , Tested
//where [cond](and|or)[cond]                //cond => "a = , < , > ,>=,<= " ////done , Tested
//groupby [thing(s)]                                                        ////done , Tested
//having [cond] (and|or) [cond]                                            //// done , Tested
//orderby [thing(s)]               



},
"ins"=> function(){





},
"del"=> function(){

$replacer=new Replacer("?");

$this->initall();

}


]

  public function __get($name) {
      $matches=[];
     if(preg_match("/^up$/" ,$name, $matches ))
        {
        $this->up($matches[1],$matches[2],$args);
        }
         else if(preg_match("/^sel$/" ,$name, $matches ))
        {
        $this->having($matches[1],$matches[2],$args);
        }
         else if(preg_match("/^del$/" ,$name, $matches ))
        {
        $this->having($matches[1],$matches[2],$args);
        }
        else if(preg_match("/^ins$/" ,$name, $matches ))
        {
        $this->having($matches[1],$matches[2],$args);
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

