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
<form name="myform" id="myform" action="/blog/admin/user/update/" method="post" >
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

                if(isset($action) && $action == 2 && $user->getId()==$updateId){
                    echo "<tr>";
                    echo "<td>" . $user->getId() . "</td>";
                    echo "<td><input type='text' name='username' value='" . $user->getUsername() . "'></td>";
                    echo "<td><input type='text' name='email' value='" . $user->getEmail() . "'></td>";
                    echo "<td><input type='text' name='phone' value='" . $user->getPhone() . "'></td>";
                    echo "<td><input type='text' name='type' value='" . $user->getType() . "'></td>";
                    echo "<td><a onclick='submitform(".$user->getId().");'   class='waves-effect waves-light btn'>save</a></td>";
                    echo "<td><a href='/blog/admin/user/list/' class='waves-effect waves-light btn'>cancel</a></td>";
                    echo "</tr>";

                }else{
                    echo "<tr>";
                    echo "<td>" . $user->getId() . "</td>";
                    echo "<td>". $user->getUsername() ."</td>";
                    echo "<td>".$user->getEmail()  ."</td>";
                    echo "<td>". $user->getPhone() ."</td>";
                    echo "<td>". $user->getType() ."</td>";
//                    echo "<td><a onclick='submitform(".$user->getId().");'   class='waves-effect waves-light btn'>edit</a></td>";
                    echo "<td><a href='/blog/admin/user/update/" . $user->getId() . "'  class='waves-effect waves-light btn'>Edit</a></td>";
                    echo "<td><a href='/blog/admin/user/delete/" . $user->getId() . "' class='waves-effect waves-light btn'>Del</a></td>";
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


        myform.appendChild(id);
        myform.submit();
        document.myform.submit();
    }

</script>


<?php
include "footer.php";
?>

