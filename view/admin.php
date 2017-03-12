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

    <div >
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
                    <tr>
                    <td> <?= $user->id ?></td>;
                    <td><input type='text' name='username' value='<?= $user->name?> '></td>
                    <td><input type='text' name='email' value='<?= $user->email ?> '></td>
                    <td><input type='text' name='phone' value='<?=$user->gender?>'></td>
                    <td><input type='text' name='type' value='<?=$user->type?>'></td>
                    <td><input type='checkbox' name='ban' >1</td>
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
                    <td><input type='checkbox' name='ban' >1</td>
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

<script  >

    function submitform(userid)
    {

        var myform = document.getElementById("myform");
        var id = document.createElement("input");
        id.name = "saveid";
        id.type = "hidden";
        id.value=userid;

        alert(id);
        myform.appendChild(id);
        myform.submit();
        document.myform.submit();
    }

</script>


<?php
include "footer.php";
?>

