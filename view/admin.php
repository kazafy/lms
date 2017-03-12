<?php
/**
 * Created by PhpStorm.
 * User: kazafy
 * Date: 20/02/17
 * Time: 01:40 م
 */
include "header.php";
include "nav.php";


?>

<div class="container" >

    <div class="row" >
        <div class="row ">
            <!--Card Panel-->
            <div class=" col l3 card hoverable ">
                <h5 class="center-align" >users</h5>
                <p class="center-align"><?= $userNumbers ?></p>
            </div>
            <!--Card Panel-->
            <div class=" col l3 card hoverable ">
                <h5 class="center-align" >category</h5>
                <p class="center-align"><?= $categoryNumbers ?></p>
            </div>
            <!--Card Panel-->
            <div class=" col l3 card hoverable ">
                <h5 class="center-align" >course</h5>
                <p class="center-align"><?= $courseNumbers ?></p>
            </div>
            <!--Card Panel-->
            <div class=" col l3 card hoverable ">
                <h5 class="center-align" >uploaded files</h5>
                <p class="center-align"><?= $materialNumbers ?></p>
            </div>
        </div>


        <div class="card hoverable">

            <ul class="collection">
                <?php foreach ($requests as $request){ ?>
                    <?php
                    ?>

                <li class="collection-item avatar">
                    <img src="<?= $request->creatorid->picture;?>" alt="" class="circle">
                    <p>
                    <span class="title"><b><?= $request->creatorid->name; ?></b></span>
                    <?= $request->title;?>
                    <?= $request->body;?></p>
                    <a href="/lms/request/delete/<?=$request->id?>" class="secondary-content"><i class="material-icons">delete</i></a>
                </li>
                <?php } ?>
            </ul>

        </div>



    <div class="card hoverable" >
    <form name="myform" id="myform" action="/lms/admin/user/update/0" method="post" >
        <table class="highlight centered bordered">
            <thead>
            <tr>
                <th data-field="id">id</th>
                <th data-field="username">Name</th>
                <th data-field="email">email</th>
                <th data-field="phone">gender</th>
                <th data-field="admin">type</th>
                <th data-field="admin">ban</th>
            </tr>
            </thead>
            <tbody>
            <?php

                foreach ( $users as $user) {

                    if(isset($action) && $action == 2 && $user->id==$updateId){
                        ?>
                        <td> <?= $user->id ?></td>

                        <td><input type='text'  name='username' value='<?= $user->name?> '></td>
                        <td><input type='text' name='email' value='<?= $user->email ?> '></td>
                        <td>
                            <select name="gender" class="browser-default">
                                <option value="0" <?=($user->gender==0)?'selected':'';?> >Male</option>
                                <option value="1" <?=($user->gender==1)?'selected':'';?> >Female</option>
                            </select>
                        </td>

                        <td>
                        <td>
                            <select name="type" class="browser-default">
                                <option value="0" <?=($user->type==1)?'selected':'';?> >Admin</option>
                                <option value="1" <?=($user->type==2)?'selected':'';?> >User</option>
                            </select>
                        </td>
                        </td>
                        <td>
                            <p>
                                <input type="checkbox" id="ban" />
                                <label for="ban">ban</label>
                            </p>
                                <input type='checkbox' class="browser-default" name='ban' value="1" />
                        </td>

                        <td><a onclick='submitform("<?=$user->id?>");'   class='waves-effect waves-light btn-block'>
                                <i class="material-icons">save</i>
                                </a></td>
                        <td><a href='/lms/admin/user/list/' class='waves-effect waves-light btn-block'>
                                <i class="material-icons">cancel</i>
                               </a></td>
                        </tr>

                    <?php

                    }else{
                        ?>
                        <tr>
                        <td> <?=$user->id ?> </td>
                        <td><?= $user->name ?></td>
                        <td><?=$user->email ?></td>
                        <td><?=($user->gender == 0 )?'male':'female' ?></td>
                        <td><?=($user->type == 1 )?'user':'admin' ?></td>
                        <td>
                            <p class="center-align">
                                <input type="checkbox" disabled <?= ($user->ban==0)? 'checked':''?> id="ban<?= $user->id ?>" />
                                <label for="ban<?= $user->id ?>"></label>
                            </p>

                        </td>

                        <td><a href='/lms/admin/user/update/<?= $user->id; ?>'  class='right  btn-block waves-effect waves-light '>
                                <i class="material-icons">edit</i>
                                </a></td>
                        <td><a href='/lms/admin/user/delete/<?= $user->id;?>' class='waves-effect waves-light btn-block'>
                                <i class="material-icons">delete</i>
                                </a></td>
                        </tr>
                    <?php
                    }
        }
            ?>
            </tbody>
        </table>

        <input type="hidden" name="id"  />
    </form>
    </div>



    </div>
</div>

<script  >

    function submitform(userid)
    {

        var myform = document.getElementById("myform");
        var id = document.createElement("input");
        id.name = "saveid";
        id.type = "hidden";
        id.value=userid;

        myform.appendChild(id);
        myform.submit();
        document.myform.submit();
    }

</script>


<?php
include "footer.php";
?>

