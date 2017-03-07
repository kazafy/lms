<?php
/**
 * Created by PhpStorm.
 * User: kazafy
 * Date: 25/02/17
 * Time: 11:13 م
 */
include "header.php";
include "nav.php";

?>


<div class="container">

    <div class="row l1">

    </div>
    <div class="row l11">
        <div class="col l8">

            <!--card-->
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card ">
                        <div class="card-image">
                            <img src="<?php echo $post->getImg();?>">
                            <span class="card-title"><?php echo $post->getHeader(); ?></span>
                        </div>
                        <div class="card-content">
                            <?php echo $post->getText(); ?>
                        </div>
                        <div class="card-action">
                            <?php if(! empty($user) && $user->getType()== 0)
                                {
                                    ?>
                            <a class="right" href="">edit</a>
                            <a class="right" href="#">delete</a>

                            <?php
                                    }elseif(! empty($user) && $user->getId() == $post->getId())
                                         {  ?>
                            <a class="right" href="">edit</a>
                            <?php   }?>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-content">

                        <ul class="collection">
                            <li class="collection-item " >
                                <div class="row">

                                    <div class="input-field col s12">
                                        <textarea id="textarea1" class="materialize-textarea"></textarea>
                                        <label for="textarea1">Textarea</label>
                                    </div>
                                    <input class="right btn-flat" value="Send" type="submit"></input>
                                </div>

                            </li>
                            <li class="collection-item avatar">
                                <i class="material-icons circle">folder</i>
                                <span class="title">Title</span>
                                <p>First Line <br> Second Line
                                </p>
                                <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                            </li>
                            <li class="collection-item avatar">
                                <i class="material-icons circle green">insert_chart</i>
                                <span class="title">Title</span>
                                <p>First Line <br> Second Line
                                </p>
                                <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                            </li>
                            <li class="collection-item avatar">
                                <i class="material-icons circle red">play_arrow</i>
                                <span class="title">Title</span>
                                <p>First Line <br> Second Line
                                </p>
                                <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                            </li>
                            <li class="collection-item avatar">
                                <i class="material-icons circle green">insert_chart</i>
                                <span class="title">Title</span>
                                <p>First Line <br> Second Line
                                </p>
                                <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
                            </li>
                        </ul>

                        </div>

                    </div>


                </div>
            </div>
        </div>
        <!--card-->



        <div class="col l4">
            <div class="row">
                <div class="col  s12 m12 l12">
                    <div class="card small">
                        <div class="card-image">
                            <img src="<?php echo $writer->getImg();?>">
                            <span class="card-title"><?php echo $writer->getUsername(); ?></span>
                        </div>
                        <div class="card-content">
                            <p>I am a very simple card. I am good at containing small bits of information. I am convenient
                                because I require little markup to use effectively.</p>
                        </div>
                        <div class="card-action">
                            <a href="#">All <?php echo $writer->getUsername(); ?> posts </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</div>



<?php
include "footer.php";
?>

