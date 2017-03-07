<?php
/**
 * Created by PhpStorm.
 * User: kazafy
 * Date: 27/02/17
 * Time: 08:50 ص
 */

include "header.php";
include "nav.php";

?>

<div class="container">
<div class="row">
<form action="/lms/admin/post/add/" method="post" enctype="multipart/form-data">
    <div class="input-field col s12">
        <textarea name="header" rows="250" id="header" class="materialize-textarea"></textarea>
        <label for="header">Header</label>
    </div>

    <div class="input-field col s12">
        <textarea rows="250" name="keywords" id="keywords" class="materialize-textarea"></textarea>
        <label for="keywords">Keywords</label>
    </div>

    <div class="input-field col s12">
        <textarea rows="250" name="text" id="text" class="materialize-textarea"></textarea>
        <label for="text">Text</label>
    </div>
    <div class="file-field input-field col s12">

        <div class="btn">
            <span>File</span>
            <input type="file" name="image" id="img">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
        </div>
    </div>

    <input class="right btn-flat" id="submit" name="submit" value="save" type="submit"></input>
    <a href="/lms/home/" class="right btn-flat" >cancel</a>

</form>
</div>

</div>

<?php
include "footer.php";
?>
