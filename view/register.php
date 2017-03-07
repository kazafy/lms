<?php
/**
 * Created by PhpStorm.
 * User: kazafy
 * Date: 25/02/17
 * Time: 11:16 م
 */

include "header.php";
include "nav.php";

?>


    <div class="container">

        <div class="row ">
            <div class="col s12 offset-m3 m6 offset-l4  l4">
                <div class="card hoverable">
                    <form method="post" action="">
                        <div class="row ">
                            <div class="input-field col offset-s1 s10">
                                <i class="material-icons prefix">perm_identity</i>
                                <input id="username" name="username" type="text" class="validate">
                                <label for="username">User Name</label>
                            </div>
                            <div class="input-field col offset-s1 s10">
                                <i class="material-icons prefix">email</i>
                                <input id="email" name="email" type="email" class="validate">
                                <label for="email">Email</label>
                            </div>

                            <div class="input-field col offset-s1 s10">
                                <i class="material-icons prefix">lock</i>
                                <input id="password" name="password" type="password" class="validate">
                                <label for="password">Password</label>
                            </div>
                            <div class="input-field col offset-s1 s10">
                                <i class="material-icons prefix">lock_outline</i>
                                <input id="repassword" type="password" class="validate">
                                <label for="repassword">Password</label>
                            </div>
                            <!--offset-s2 s10 offset-l2 l10-->
                            <div class="col offset-s1 s11 ">
                                <p>
                                    <input type="checkbox" id="test5" />
                                    <label for="test5">Remember Me</label>

                                </p>
                            </div>
                            <div class="col s12">
                                <br />
                            </div>
                            <div class="col s12">
                                <button class="btn  red  col offset-s1 offset-l1 s10 l10 waves-effect waves-light" type="submit" name="submit">Login
                                </button>

                            </div>

                            <div class="col offset-s1 s10">
                                <div class="row ">
                                    <p class="center-align ">Already have an account?<a href="#" > Login</a></p>
                                </div>
                            </div>
                            <div class="col offset-s1 s10">
                                <span><?php if(!empty($emailErr)) echo $emailErr;?></span>
                                <span><?php if (!empty($passwordErr)) echo $passwordErr;?></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>



<?php
include "footer.php";
?>