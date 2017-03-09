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
        </div>
        <hr/>

        <div class="row l11">

            <!--center -->
            <div class="col s12  m12 l12 ">

                <?php foreach ($blocks as $block) { ?>

                    <!--card-->

                <div class="col s12 m6 l3" >
                    <div class="card horizontal hoverable">

                        <div class="card-stacked">
                            <div class="card-content" onclick="window.location.replace('<?php echo $_SERVER['REQUEST_URI']; echo $block->name;?>/')">
                                        <p class="truncate teal-text"> <?php echo $block->name;?></p>
                            </div>
                            <div class="card-action">
                                <a class="left" href="#">5 c</a>

                                <?php  if(! empty($user) && $user->type == 0)
                                {
                                    ?>
                                    <a class="right  btn-block waves-effect waves-light "
                                       href="/lms/admin/post/update/<?php echo $block->id;?>"><i class="material-icons">edit</i></a>
                                    <a class="right btn-block  waves-effect waves-light "
                                       href="/lms/<?php echo $block->tablename;?>/delete/<?php echo $block->id;?>"><i class="material-icons">delete</i></a>

                                    <?php
                                }elseif(! empty($user) && $user->id == $block->creatorid)
                                {  ?>
                                    <a class="right btn-block  waves-effect waves-light "
                                       href="/lms/admin/post/update/<?php echo $block->id;?>"><i class="material-icons">edit</i></a>
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

        </div>


    </div>
</div>


</div>
</div>

<?php
include "footer.php";
?>
