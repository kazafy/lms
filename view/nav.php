<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper black">
            <a href="/views/" class="brand-logo">ITIans</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>

            <div class="right hide-on-med-and-down">
                <ul>
                    <li><a class="active" href="/views/">Home</a></li>
                    <?php if(isset($user) && !empty($user)){ ?>
                        <li><a class="active" href="/profile/">Profile</a></li>
                        <?php
                            if ($user->type == 0){
                        ?>
                        
                        <li><a href="/admin/user/list/">Control Panel</a></li>
                                <?php }?>
                    <li><a href="/logout/"> logout </a></li>
                    <?php  } else {?>
                    <li><a class="active" href="/register/">Register</a></li>
                    <li><a href="/login/">login</a></li>
                    <?php  } ?>


                </ul>
            </div>

            <ul class="side-nav" id="mobile-demo">
                <li><a href="/login/"><i class="material-icons">person_pin</i></a></li>
                <li><a href="/register/"><i class="material-icons">contacts</i></a></li>
            </ul>
        </div>
    </nav>
</div>
