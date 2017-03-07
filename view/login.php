<?php
/**
 * Created by PhpStorm.
 * User: kazafy
 * Date: 24/02/17
 * Time: 10:01 م
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
                                <input id="email" name="email" value="<?php if(!empty($user)) echo $user->getEmail();?>" type="email" class="validate">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col offset-s1 s10">
                                <i class="material-icons prefix">lock_outline</i>
                                <input id="password" name="password" type="password" class="validate">
                                <label for="password">Password</label>
                            </div>
                            <!--offset-s2 s10 offset-l2 l10-->
                            <div class="col offset-s1 s11 ">
                                <p>
                                    <input type="checkbox" id="test5" name="rememberme" />
                                    <label for="test5">Remember Me</label>

                                </p>
                            </div>
                            <div class="col s12">
                                <br />
                            </div>
                            <div class="col s12">
                                <button class="btn  red  col offset-s1 offset-l1 s10 l10 waves-effect waves-light"  type="submit" name="submit">Login
                                </button>

                            </div>
                            <div class="col s12">
                                <br />
                            </div>

                            <div class="col offset-s1 s10">
                                <div class="row ">
                                    <a href="#" >Create Acount</a>
                                    <a href="#" class="right">Forget Password</a>
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