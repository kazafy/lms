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
<form name="myform" id="myform" action="/lms/admin/user/update/0" method="post" >
    <table class="highlight centered bordered">
        <thead>
        <tr>
            <th data-field="id">id</th>
            <th data-field="username">Name</th>
            <th data-field="email">skills</th>
            <th data-field="phone">gender</th>
            <th data-field="admin">mail</th>
        </tr>
        </thead>
        <tbody>
        <?php

            foreach ( $users as $user) {

                if(isset($action) && $action == 2 && $user->id==$updateId){
                    echo "<tr>";
                    echo "<td>" . $user->id . "</td>";
                    echo "<td><input type='text' name='username' value='" . $user->name . "'></td>";
                    echo "<td><input type='text' name='email' value='" . $user->email . "'></td>";
                    echo "<td><input type='text' name='phone' value='" . $user-> state. "'></td>";
                    echo "<td><input type='text' name='type' value='" . $user->type . "'></td>";
                    echo "<td><a onclick='submitform(".$user->id.");'   class='waves-effect waves-light btn'>save</a></td>";
                    echo "<td><a href='/lms/admin/user/list/' class='waves-effect waves-light btn'>cancel</a></td>";
                    echo "</tr>";

                }else{
                    echo "<tr>";
                    echo "<td>" . $user->id . "</td>";
                    echo "<td>". $user->name ."</td>";
                    echo "<td>".$user->email ."</td>";
                    echo "<td>". $user->state ."</td>";
                    echo "<td>". $user->type ."</td>";
//                    echo "<td><a onclick='submitform(".$user->getId().");'   class='waves-effect waves-light btn'>edit</a></td>";
                    echo "<td><a href='/lms/admin/user/update/" . $user->id . "'  class='waves-effect waves-light btn'>Edit</a></td>";
                    echo "<td><a href='/lms/admin/user/delete/" . $user->id . "' class='waves-effect waves-light btn'>Del</a></td>";
                    echo "</tr>";
                }



            }
        ?>
        </tbody>
    </table>

    <input type="hidden" name="id"  />
</form>


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

