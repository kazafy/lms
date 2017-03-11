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
            <div id="center" class="col s12  m12 l12 ">

                <?php foreach ($blocks as $block) { ?>

                    <!--card-->

                <div  class="col s12 m6 l3" >
                    <div class="card horizontal hoverable">

                        <div id="card<?= $block->id?>" class="card-stacked">
                            <div class="card-content" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; echo $block->name;?>/'">
                                        <p class="truncate teal-text"> <?php echo $block->name;?></p>
                            </div>
                            <div class="card-action">
                                <a class="left" href="#">5 c</a>

                                <?php  if(! empty($user) && $user->type == 0)
                                {
                                    ?>
                                    <a onclick='editblock(<?= $block->id?>)' class="right  btn-block waves-effect waves-light "><i class="material-icons">edit</i></a>
                                    <a class="right btn-block  waves-effect waves-light "
                                       href="/lms/<?php echo $block->tablename;?>/delete/<?php echo $block->id;?>"><i class="material-icons">delete</i></a>

                                    <?php
                                }elseif(! empty($user) && $user->id == $block->creatorid)
                                {  ?>
                                    <a onclick="editblock(<?= $block->id?>)" class="right btn-block  waves-effect waves-light "><i class="material-icons">edit</i></a>
                                <?php   }?>


                            </div>
                        </div>

                        <div id="cardh<?= $block->id?>" class="card-stacked hide">


                            <div class="card-content ">

                                <div class="input-field">

                                    <input id="name" type="text" value="<?= $block->name?>" name='name' class="validate">
                                    <label for="name">name</label>
                                </div>
                                <div class="input-field">
                                    <input id="desc" type="text" name="desc" value="<?= $block->description?>" class="validate">
                                    <label for="desc">description</label>
                                </div>
                                <?php if($level == 0) {
                                    ?>
                                    <input type="hidden" name="parent" value="<?=$parentId?>"/>
                                    <label for="cat">Select Category</label>
                                    <div class="input-field">
                                        <select id="cat" name="category" class="browser-default">
                                            <?php
                                            foreach ($catogeries as $category) {
                                                ?>
                                                <option  value="<?= $category -> id; ?> <?= ($category->id== $block->categoryid?'selected':'' )?>"><?= $category->name; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <?php
                                    foreach ($block->types as $type) {
                                        ?>
                                        <div class="input-field">

                                            <input name="types[]" value="<?php echo $type->id; ?>" type="checkbox" id="t<?php echo $type->id; ?>"/>
                                            <label for="t<?php echo $type->id; ?>"><?php echo $type->name; ?></label>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>

                            </div>
                            <div class="card-action">
                                <button onclick="editblock(<?= $block->id?>)"  type="reset" class="btn-block waves-effect waves-light "><i class="material-icons">cancel</i></button>
                                <!--                            <input type="submit" class="btn waves-effect waves-light"><i class="material-icons">save</i></input>-->

                                <button class="btn-block right waves-effect waves-light" type="submit" name="action">
                                    <i class="material-icons right">save</i>
                                </button>
                            </div>








                        </div>
                    </div>

                </div>
                <!--card-->
                <?php }?>
                <div id="addCard"  class="col s12 m6 l3">
                        <div class="card  hoverable">
                                <div onclick="addblock();" class="card-content ">
                                    <h3>+</h3>
                                </div>
<!--                                <div class="card-action">-->
<!--                                    <a onclick="removeMe()" class="btn-block waves-effect waves-light "><i class="material-icons">cancel</i></a>-->
<!--                                    <a class=" right btn-block  waves-effect waves-light "-->
<!--                                       href="#"><i class="material-icons">save</i></a>-->
<!---->
<!--                                </div>-->
                        </div>
                </div>

                <div id="newblock"  class="col s12 m6 l3 hide">
                    <form id="idForm" method="post" action="/lms/api/add/<?php echo $level;?>"  enctype="multipart/form-data" >

                    <div class="card  hoverable">

                        <div class="card-content ">

                            <div class="input-field">

                            <input id="name" type="text" name='name' class="validate">
                            <label for="name">name</label>
                            </div>
                            <div class="input-field">
                            <input id="desc" type="text" name="desc" class="validate">
                            <label for="desc">description</label>
                            </div>
                            <?php if($level == 0) {
                                ?>
                                <input type="hidden" name="parent" value="<?=$parentId?>"/>
                                <label for="cat">Select Category</label>
                            <div class="input-field">
                                <select id="cat" name="category" class="browser-default">
                                    <?php
                                        foreach ($catogeries as $category) {
                                            ?>
                                            <option value="<?= $category -> id; ?>"><?= $category->name; ?></option>
                                            <?php
                                        }
                                            ?>
                                </select>
                            </div>

                            <?php
                                foreach ($types as $type) {
                                    ?>
                            <div class="input-field">

                                    <input name="types[]" value="<?php echo $type->id; ?>" type="checkbox" id="t<?php echo $type->id; ?>"/>
                                    <label for="t<?php echo $type->id; ?>"><?php echo $type->name; ?></label>
                            </div>
                                    <?php
                            }
                            }
                            else if($level == 1){

                                ?>

                                <div class="file-field input-field">
                                    <div class="btn-large">
                                        <span>File</span>
                                        <input name="file" type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>
                                <input type="hidden" name="parent" value="<?=$parentId?>"/>

                                <?php

                            }
                            ?>

                        </div>
                        <div class="card-action">
                            <button onclick="removeMe()" type="reset" class="btn-block waves-effect waves-light "><i class="material-icons">cancel</i></button>
<!--                            <input type="submit" class="btn waves-effect waves-light"><i class="material-icons">save</i></input>-->

                            <button class="btn-block right waves-effect waves-light" type="submit" name="action">
                                <i class="material-icons right">save</i>
                            </button>
                        </div>

                    </div>
                    </form>
                </div>



        </div>

    </div>
</div>


</div>
</div>

<?php

include "footer.php";
?>
<script>

    function addblock() {

        var card = document.getElementById("newblock");
        card.classList.toggle("hide");
        var addCard = document.getElementById("addCard");
        addCard.classList.toggle("hide")
    };
    function removeMe() {
        var card = document.getElementById("newblock");
        card.classList.toggle("hide");
        document.getElementById("name").value="";
        document.getElementById("desc").value="";
        var addCard = document.getElementById("addCard");
        addCard.classList.toggle("hide");
        return;

    }
    function editblock(id) {
        var card  = document.getElementById("card"+id);
        var cardh = document.getElementById("cardh"+id);

        card.classList.toggle("hide");
        cardh.classList.toggle("hide");

    }

//    $("#idForm").submit(function(e) {
//        var url = "/lms/api/add/"+"<?php //echo $level;?>//"; // the script where you handle the form input.
//        $.ajax({
//            type: "POST",
//            enctype:"multipart/form-data",
//            url: url,
//            data: $("#idForm").serialize(), // serializes the form's elements.
//            success: function(data)
//            {
//                alert(data); // show response from the php script.
//            }
//        });
//        e.preventDefault(); // avoid to execute the actual submit of the form.
//    });
    $("#idForm").submit(function() {

        var formData = new FormData($(this)[0]);

        $.post($(this).attr("action"), formData, function(data) {
            alert(data);
        });

        return false;
    });

</script>

