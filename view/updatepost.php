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
        <form action="/lms/admin/post/update/<?php echo $post->getId()?>" method="post" enctype="multipart/form-data">
            <div class="input-field col s12">
                <textarea name="header" rows="250" id="header" class="materialize-textarea">
                    <?php echo $post->getHeader(); ?>
                </textarea>
                <label for="header">Header</label>
            </div>

            <div class="input-field col s12">
                <textarea rows="250" name="keywords" id="keywords" class="materialize-textarea">
                    <?php  echo $post->getKeywords(); ?>
                </textarea>
                <label for="keywords">Keywords</label>
            </div>

            <div class="input-field col s12">
                <textarea rows="250" name="text" id="text" class="materialize-textarea">
                    <?php echo $post->getText(); ?>
                </textarea>
                <label for="text">Text</label>
            </div>

            <input class="right btn-flat" id="submit" name="submit" value="save" type="submit"></input>
            <a href="/lms/home/" class="right btn-flat" >cancel</a>

        </form>
    </div>

</div>

<?php
include "footer.php";
?>
