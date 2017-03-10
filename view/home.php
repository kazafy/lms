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

                <div class="col s12 m6 l3" >
                    <div class="card horizontal hoverable">

                        <div class="card-stacked">
                            <div class="card-content" onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; echo $block->name;?>/'">
                                        <p class="truncate teal-text"> <?php echo $block->name;?></p>
                            </div>
                            <div class="card-action">
                                <a class="left com" href="<?=$block->id?>">5 c</a>

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
                    <form id="idForm" >

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
                                <label for="cat">Select Category</label>
                            <div class="input-field">
                                <select id="cat" class="browser-default">
                                    <?php
                                        foreach ($catogeries as $category) {
                                            ?>
                                            <option value="<?= $category - id; ?>"><?= $category->name; ?></option>
                                            <?php
                                        }
                                            ?>
                                </select>
                            </div>
                            <div class="input-field">

                            <?php
                                foreach ($types as $type) {
                                    ?>
                                    <input type="checkbox" id="t<?php echo $type->id; ?>"/>
                                    <label for="t<?php echo $type->id; ?>"><?php echo $type->name; ?></label>
                                    <?php
                            }
                            }
                            else if($level == 1){

                                ?>

                                <div class="file-field input-field">
                                    <div class="btn-large">
                                        <span>File</span>
                                        <input type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text">
                                    </div>
                                </div>

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



















<div id="modal" class="modal">
  <div class="modal-content">
    <h4>Comments</h4>
    <div id="modal_content" class="row">
        <div class="row">
        <h2>sdklfjsdlkfjsssssssfsdfdsfkjgfkhekagfuisdjkfsdkjhfkjsssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</h2>
    </div>
        <div class="row">
        <h2>sdklfjsdlkfjsssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss</h2>
    </div>
        <div class="row">
        sdklfjsdlkfjsssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss
    </div>
      
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Ok</a>
    </div>
  </div>
</div>















<?php

include "footer.php";
?>
<script>
 $(document).ready(function(){
  $('#modal').modal();
  });


 $(".com").click(
   function(e){
console.log($(this).attr('href'));
  var url = "/lms/api/comments/get/"+$(this).attr('href');
      $.ajax({
            type: "POST",
            url: url,
            success: function(mydata)
            {
                mydata=JSON.parse(mydata);
                console.log(mydata.length);
 console.log(mydata[0]);

                $("#modal_content").empty();
                        for(i=0;i<mydata.length;i++){
                                var elem=$("<div>");
                               elem.append("<p>"+mydata[i].creatorname+":"+mydata[i].body);
                                $("#modal_content").append(elem);


                        }




                alert("RECE"); // show response from the php script.
                console.log(mydata);
            }
        });
e.preventDefault();
//$(this).

$('#modal').modal('open');





     
 }
 );
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

    $("#idForm").submit(function(e) {
        var url = "/lms/api/add/"+"<?php echo $level;?>"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            url: url,
            data: $("#idForm").serialize(), // serializes the form's elements.
            success: function(data)
            {
                alert(data); // show response from the php script.
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });

</script>

