<?php
/**
 * Created by PhpStorm.
 * User: kazafy
 * Date: 25/02/17
 * Time: 11:03 م
 */
include "header.php";
include "nav.php";

?>


<div class="container">

    <div class="col">
        <div class="row ">
            <div class="col offset-l1 l10">
                <br>
                <a class="btn-flat" >Tech</a> >
                <a class="btn-flat"  >programming</a> >
                <a class="btn-flat" >java</a>
            </div>
<!--            <div class="card col l3">-->
<!--                <h4 class="truncate">This is an extremely long title that will be truncated</h4>-->
<!--            </div>-->
<!--            <div class="card col l3">-->
<!--                <h4 class="truncate">This is an extremely long title that will be truncated</h4>-->
<!--            </div>        -->
        </div>
        <hr/>

        <div class="row l11">

            <!--center -->
            <div class="col s12  m12 l12 ">

                <?php foreach ($blocks as $block) { ?>

                    <!--card-->

                <div class="col s12 m6 l3">
                    <div class="card horizontal hoverable">

                        <div class="card-stacked">
                            <div class="card-content ">
                                        <p class="truncate teal-text"> <?php echo $block->getText();?></p>
                            </div>
                            <div class="card-action">
                                <a class="left" href="#">5 c</a>

                                <?php if(! empty($user) && $user->getType()== 0)
                                {
                                    ?>
                                    <a class="right  btn-block waves-effect waves-light "
                                       href="/lms/admin/post/update/<?php echo $block->getId();?>"><i class="material-icons">edit</i></a>
                                    <a class="right btn-block  waves-effect waves-light "
                                       href="/lms/admin/post/delete/<?php echo $block->getId();?>"><i class="material-icons">delete</i></a>

                                    <?php
                                }elseif(! empty($user) && $user->getId() == $block->getUserId())
                                {  ?>
                                    <a class="right btn-block  waves-effect waves-light "
                                       href="/lms/admin/post/update/<?php echo $block  ->getId();?>"><i class="material-icons">edit</i></a>
                                <?php   }?>


                            </div>
                        </div>
                    </div>

                </div>
                <!--card-->
                <?php }?>
                <div class="col s12 m6 l3">
                        <div class="card horizontal hoverable">
<!--                                <div class="card-content valign-wrapper">-->
<!---->
<!--                                    <h5 class="valign">+</h5>-->
<!---->
<!---->
<!--                                </div>-->
                                <div class="card-action">
                                    +
                                </div>
                        </div>
                </div>

                <!---->
<!--            </div>-->
<!--            <!--tab-->
<!--            <div class="col s12 l4 ">-->
<!---->
<!---->
<!--                <ul id="tabs-swipe-demo" class="tabs">-->
<!--                    <li class="tab col l6"><a class="active" href="#test-swipe-1">Recently</a></li>-->
<!--                    <li class="tab col l6"><a class="active" href="#test-swipe-2">Most Seen</a></li>-->
<!--                </ul>-->
<!--                <div id="test-swipe-1" class="col s12 ">-->
<!---->
<!--                    <ul class="collection">-->
<!--                        <li class="collection-item avatar">-->
<!--                            <i class="material-icons circle green">insert_chart</i>-->
<!--                            <span class="title">Title</span>-->
<!--                            <p>First Line <br> Second Line-->
<!--                            </p>-->
<!--                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>-->
<!--                        </li>-->
<!--                        <li class="collection-item avatar">-->
<!--                            <i class="material-icons circle">folder</i>-->
<!--                            <span class="title">Title</span>-->
<!--                            <p>First Line <br> Second Line-->
<!--                            </p>-->
<!--                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>-->
<!--                        </li>-->
<!--                        <li class="collection-item avatar">-->
<!--                            <i class="material-icons circle green">insert_chart</i>-->
<!--                            <span class="title">Title</span>-->
<!--                            <p>First Line <br> Second Line-->
<!--                            </p>-->
<!--                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>-->
<!--                        </li>-->
<!--                        <li class="collection-item avatar">-->
<!--                            <i class="material-icons circle red">play_arrow</i>-->
<!--                            <span class="title">Title</span>-->
<!--                            <p>First Line <br> Second Line-->
<!--                            </p>-->
<!--                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!---->
<!--                </div>-->
<!--                <div id="test-swipe-2" class="col s12 ">-->
<!--                    <ul class="collection">-->
<!--                        <li class="collection-item avatar">-->
<!--                            <i class="material-icons circle">folder</i>-->
<!--                            <span class="title">Title</span>-->
<!--                            <p>First Line <br> Second Line-->
<!--                            </p>-->
<!--                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>-->
<!--                        </li>-->
<!--                        <li class="collection-item avatar">-->
<!--                            <i class="material-icons circle green">insert_chart</i>-->
<!--                            <span class="title">Title</span>-->
<!--                            <p>First Line <br> Second Line-->
<!--                            </p>-->
<!--                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>-->
<!--                        </li>-->
<!--                        <li class="collection-item avatar">-->
<!--                            <i class="material-icons circle red">play_arrow</i>-->
<!--                            <span class="title">Title</span>-->
<!--                            <p>First Line <br> Second Line-->
<!--                            </p>-->
<!--                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>-->
<!--                        </li>-->
<!--                        <li class="collection-item avatar">-->
<!--                            <i class="material-icons circle green">insert_chart</i>-->
<!--                            <span class="title">Title</span>-->
<!--                            <p>First Line <br> Second Line-->
<!--                            </p>-->
<!--                            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!---->
<!--                </div>-->
<!---->
<!---->
<!---->
<!--            </div>-->
        </div>


    </div>
</div>


</div>
</div>

<?php
include "footer.php";
?>
