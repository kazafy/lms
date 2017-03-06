<?php
        

class Generator{
private $characterwhole;
private static $seed=0;
function __construct($characterwhole,$prefix="",$postfix=""){
$this->characterwhole=$prefix.$characterwhole.$postfix;
}
public function __invoke($number){
$argsgenerated=[];
for($i=0;$i<$number;$i++)
    $argsgenerated[]=$this->characterwhole.(self::$seed++);

return $argsgenerated;
}


}
