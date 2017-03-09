<?php
require_once( "hybridauth-2.8.2/hybridauth/Hybrid/Auth.php");
if (isset($_POST['fbauth']))
{
  $config= dirname(__FILE__) . 'hybridauth-2.8.2/hybridauth/config.php';
  $hybridauth = new Hybrid_Auth( $config_file_path );
  try{

    	$hybridauth = new Hybrid_Auth( $config );
      $adapter = $hybridauth->authenticate( "Facebook" );
      $user_profile = $adapter->getUserProfile();
    }
  catch( Exception $e ){
        die("<b>got an error </b>".$e->getMessage());
     }
     if (isset($user_profile))
     {
       die(var_dump($user_profile));
     }

/*echo $twitter_user_profile;
// update the user status
$adapter->setUserStatus(
array(
   "message" => "hello world", // status or message content
   "link"    => "", // webpage link
   "picture" => "https://www.google.com.eg/search?q=facebook+picture&source=lnms&tbm=isch&sa=X&ved=0ahUKEwjb1aTD88bSAhUGuBQKHfKaAGIQ_AUICCgB&biw=1366&bih=640#", // a picture link
 )
);*/

}

?>
<html>
<head>
       <title>MyFile</title>
</head>
<body>
    
<form  action="<?=$_SERVER['PHP_SELF']?>" method="POST">
  <input type="hidden" name="fbauth" value="true"/>
  <input type="submit"  value="connect with facebook"/>
</form>

</body>
</html>
