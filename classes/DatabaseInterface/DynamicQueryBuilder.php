
<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
//select [selected]
//from [table(s)]
//where [cond](and|or)[cond]                //cond => "a = , < , > ,>=,<= "
//groupby [thing(s)]
//having [cond] (and|or) [cond]
//orderby [thing(s)]

//insert into tablename('value1','value2','value3');
//u



class DynamicQueryBuilder{
private $wherecondition;
private $tables;
private $whereclauses="";
private $selected;
private $grouped;
private $whatever=0;
private function where($part1,$part2,...$args){
        $replacer=new Replacer("?"))
        $matchoptionsfp=["or"=>"OR","and"=>"AND",""=>""];
        $matchoptionsp2=["eq"=>"? = ?","lt"=>"? < ?","gt"=>"? > ?","gte"=>"? >= ?","lte"=>"? < ?","b"=>"? Between ? AND ?","i"=>"? IN (?)"];
        $createdqwpart=" ";
        $createdqwpart.=$matchoptionsfp[$part1];
        $generatedp2=$replacer->replace($matchoptionsp2[$part2],$args,1);
       $replacer->replace( $generatedp2,




}

 public function __call($name, $args) {
        $matches=[];
        //(and|or|)where(eq|lt|gt|lte|gte|)
        if(preg_match("/^(and|or|)where(eq|lt|gt|lte|gte|b|i|a)$/" ,$name, $matches ))
        {
        $this->where($matches[1],$matches[3],$args)
        }
        else{
             echo "Calling  method '$name' "
             . implode(', ', $args). "\n";



        }
        
 
 }



    public static function __callStatic($name, $args)
    {
        // Note: value of $name is case sensitive.
        echo "Calling static method '$name' "
             . implode(', ', $args). "\n";
    }
}








}