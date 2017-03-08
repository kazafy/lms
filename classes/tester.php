<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
require_once("./Model.php");
require_once("./Type.php");
$c=new Type();
//User2::Fetchall()[0]->delete();
$b=Type::Fetchall()[0];
var_dump($b);
//$b->name="SERIAL KILLER";
//$c->name="ABDO";
//$c->extension=".abd";
//$c->insert();
//$c->name="Notnow";
//$c->update();
//$b->update();
