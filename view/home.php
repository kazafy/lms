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
                <?php foreach($wmtchs as $els){ ?>
                <a class="btn-flat" href=<?=$baselink.=$els."/" ?> ><?= $els?></a> >
                <?php } ?>
            </div>
        </div>
        <hr/>

        <div class="row l11">

            <!--center -->
            <div id="center" class="col s12  m12 l12 ">

                <?php foreach ($blocks as $block) { ?>

                    <!--card-->

                <div  class="col s12 m6 l4" >
                    <div class="card horizontal hoverable">

                        <div id="card<?= $block->id?> class="card-stacked">
                            <div class="card-content" <?php if ($level!=1){ ?>onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; echo $block->name;?>/' <?php } ?>">
                                        <p class="truncate teal-text"> <?php echo $block->name;?></p>
                            </div>
                            <div class="card-action">
                                
                                 <?php 
        
                                  if(! empty($user) && $level==1)
                                {
                                    ?>
                                <a class="left com" href="<?=$block->id?>"><i class="material-icons">textsms</i></a>
                                 <a class="  btn-block waves-effect waves-light "
                                       href="/lms/material/download/<?php echo $block->id;?>/"><i class="material-icons">play_for_work</i></a>
                                        <a class="  viewme btn-block waves-effect waves-light "
                                       href="<?php echo $_SERVER['REQUEST_URI']; echo $block->name;?>"><i class="material-icons">pageview</i></a>
                                <?php 
                                 }
                                    ?>
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
                                <form>
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
                                    foreach ($types as $type) {
                                        ?>
                                        <div class="input-field">

                                            <input name="types[]" <?=(in_array($type->id,$block->get_types()))?'checked':'';?> value="<?php echo $type->id;?>" type="checkbox" id="t<?php echo $block->id.$type->id; ?>"/>
                                            <label for="t<?php echo $block->id.$type->id; ?>"><?php echo $type->name; ?></label>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                </form>
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
                <div id="addCard"  class="col s12 m6 l4">
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

                <div id="newblock"  class="col s12 m6 l4 hide">
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

                            <input class="btn-block right waves-effect waves-light" type="submit" name="action">
                                <i class="material-icons right">save</i>
                            </input>
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
        
        <div id="commentspart" >
  
 
  
      </div>





<form id="subcomment" class="row">


     
      <div class="row">
        <div class="input-field col s12">
         <textarea id="Comment" class="materialize-textarea" data-length="120"></textarea>
            <label for="textarea1">Comment</label>
        </div>
      </div>
  




<button class="btn waves-effect waves-light" type="submit">Submit
    <i class="material-icons right">send</i>
  </button>




  
    </form>
  </div>
        








        











    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Ok</a>
    </div>
  </div>
</div>





<div id="modal2" class="modal">
    <iframe scrolling=0 class="viewobj" src="/lms/10.pdf"></iframe>
    </div>


<div id="modal3" class="modal">
 
    <div id="modal_content" >
     <div class="row">    
<form id="myrequest" >

 <div class="row">
     <div class="input-field col s6">
          <input  id="reqtitle" type="text" class="validate">
          <label for="reqtitle">Title</label>
        </div>
        
  </div>
 <div class="input-field col s12">
    <select id="selected">
      <option value="" disabled selected>Type</option>
      <option value="0">Course</option>
      <option value="1">Material</option>
    </select>
    <label>Materialize Select</label>
  </div>
      <div class="row">
        <div class="input-field col s12">
         <textarea id="Request" class="materialize-textarea" data-length="120"></textarea>
            <label for="textarea1">Request</label>
        </div>




      </div>
    

<div class="row">
<button class="right btn waves-effect waves-light" type="submit">Submit
    <i class="material-icons right">send</i>
  </button>
</div>



  
    </form>
    </div>
     </div>
  </div>
        

        





<?php

include "footer.php";

?>
<script>
var currmodal;
var userid = <?= $user->id; ?>;
var usertype = <?= $user->type; ?>

















 $(document).ready(function(){
  $('#modal').modal();
    $('#modal2').modal();
     $('#modal3').modal();
      $('select').material_select();
  });






 $(".req").click(
   function(e){

e.preventDefault();
//$(this).

$('#modal3').modal('open');





     
 });



$("#myrequest").submit(
   function(e){
     
     
console.log (this);
console.log($('#selected'));
console.log({body:$('#Request').val(),title:$('#reqtitle').val(),type:$('#selected').val()});
  e.preventDefault();
 
  var url = "/lms/api/requests/submit/";
        $.ajax({
            type: "POST",
            url: url,
            data: {body:$('#Request').val(),title:$('#reqtitle').val(),type:$('#selected').val()}, 
            success: function(mydata)
            {
                console.log(mydata);
             

            
            }
        });
   alert("submitted");
      $(this)[0].reset();

       
e.preventDefault();
//$(this).
$('#modal3').modal('close');

     
 }
 );











$("#subcomment").submit(
   function(e){
     
     
console.log (this);

  e.preventDefault();
  var url = "/lms/api/comments/submit/"+currmodal;
        $.ajax({
            type: "POST",
            url: url,
            data: {body:$('#Comment').val()}, 
            success: function(mydata)
            {
                console.log("Done");
             

            
            }
        });
  console.log($(this));
      $(this)[0].reset();
 url = "/lms/api/comments/get/"+currmodal;
refreshcomments(url);
       
e.preventDefault();
//$(this).


     
 }
 );












 
function refreshcomments(url){


      $.ajax({
            type: "POST",
            url: url,
            success: function(mydata)
            {
                mydata=JSON.parse(mydata);
            

                $("#commentspart").empty();
                        for(i=0;i<mydata.length;i++){
                                var elem=$("<div>");
                                elem.addClass("row");
                               elem.append("<p>"+mydata[i].creatorname+":"+mydata[i].body);
                               console.log(mydata[i].creatorid,userid);
                               
                               if(mydata[i].creatorid==userid ){
                               var link=$("<a>");
                               link.addClass('right');
                                link.addClass('waves-effect waves-light');
                                link.attr("href",'/lms/api/comments/delete/'+mydata[i].id);
                                var myi=$("<i>");
                                link.click(function kek(e){
                                   
                                                e.preventDefault();
                                                $.ajax({
                                                        type: "POST",
                                                        url: $(this).attr('href'),
                                                        success: function(e)
                                                        {
                                                           console.log(this.url);
                                                           refreshcomments(url)
                                                        }
                                                }
                                                );
                                                                                

                                });
                                 myi.addClass('material-icons');
                                 myi.text("delete");
                                 link.append(myi);
                                 elem.append(link);
                               }
                               
                                $("#commentspart").append(elem);


                        }




              
                console.log(mydata);
            }
        });








}


 $(".viewme").click(
   function(e){

e.preventDefault();
//$(this).
console.log($(this).attr("href"));
 $('.viewobj').attr("src",$(this).attr("href"));

 $('.viewobj').width( ($("#modal2").width()));
$('#modal2').modal('open');





     
 });





 $(".down").click(
   function(e){

e.preventDefault();
//$(this).
console.log($(this).attr("href"));
 $('.viewobj').attr("src",$(this).attr("href"));

 $('.viewobj').width( ($("#modal2").width()));
$('#modal2').modal('open');





     
 });

 $(".com").click(
   function(e){
currmodal=$(this).attr('href');
  var url = "/lms/api/comments/get/"+currmodal;
refreshcomments(url);
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

//    $("#idForm").submit(function(e) {
//
//        var formData = new FormData($(this)[0]);
//
////        this.preventDefault();
//
//        $.post($(this).attr("action"), formData, function(data) {
//            alert(data);
//        });
//
//        alert("lol");
//        e.preventDefault();
//        console.log(e);
//
//        return false;
//    });


    $("#idForm").submit(function(e) {
        var url = "/lms/api/add/"+"<?php echo $level;?>"; // the script where you handle the form input.
        $.ajax({
            type: "POST",
            url: url,
            data: $("#idForm").serialize(), // serializes the form's elements.
            success: function(data)
            {
             //   alert(data); // show response from the php script.
            }
        });
        e.preventDefault(); // avoid to execute the actual submit of the form.
    });

</script>

