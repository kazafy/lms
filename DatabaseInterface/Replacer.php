<?php
class Replacer{
private $charreplace;
function __construct($charreplace){
$this->charreplace=$charreplace;
}
public function replace($template,$arrayreplace,$nums=-1){
    $whole=0;
    $nums=($nums<0)?count($arrayreplace):$nums;
    $strtreturn="";  
    for($i=0;$i<strlen($template);$i++)
    {
        if($template[$i]==$this->charreplace&&$whole<$nums)
          $strtreturn.=  $arrayreplace[$whole++];
        else
         $strtreturn.=$template[$i];
    }
    return $strtreturn;
}


}