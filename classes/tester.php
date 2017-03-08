<?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
require_once("./Model.php");
require_once("./User2.php");
$c=new User2();
//User2::Fetchall()[0]->delete();
$b=User2::Fetchall()[0];
//$b->name="SERIAL KILLER";
$c->name="ABDO";
$c->extension=".abd";
$c->insert();
$c->name="Notnow";
$c->update();
//$b->update();
