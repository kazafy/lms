<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper">
            <a href="#!" class="brand-logo">Itians</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>

            <div class="right hide-on-med-and-down">
                <ul>
                    <li><a class="active" href="/lms/home/">Home</a></li>
                    <?php if(isset($user) && !empty($user)){
                            if ($user->getType()== 0){
                        ?>
                        <li><a href="/lms/admin/user/list/">Control Panel</a></li>
                                <?php }?>
                    <li><a href="/lms/logout/"> logout </a></li>
                    <?php  } else {?>
                    <li><a class="active" href="/lms/register/">Register</a></li>
                    <li><a href="/lms/login/">login</a></li>
                    <?php  } ?>


                </ul>
            </div>
            <div class="right hide-on-med-and-down">
                <form>
                    <div class="input-field">
                        <input id="search" type="search" required>
                        <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                        <i class="material-icons">close</i>
                    </div>
                </form>
            </div>


            <ul class="side-nav" id="mobile-demo">
                <li><a href="/lms/login/""><i class="material-icons">person_pin</i></a></li>
                <li><a href="/lms/register/"><i class="material-icons">contacts</i></a></li>
            </ul>
        </div>
    </nav>
</div>
