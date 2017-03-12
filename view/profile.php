<?php
include "header.php";
include "nav.php";

?>

<div class="row">
    <form action="/lms/profile/" method="post">

    <div class="col l5 offset-l2">
        <div class="row">
            <br>
        </div>

        <h4 class="collection-header center">Profile Information</h4>


        <div class="row">
            <div class="input-field col l8">
                <i class="material-icons prefix">account_circle</i>
                <input id="icon_prefix" name="studentName" type="text" class="validate" value="<?php echo $user->name; ?>">
                <label for="icon_prefix">Name</label>
            </div>

        </div>

        <div class="row">
            <div class="input-field col l8">
                <i class="material-icons prefix">email</i>
                <input id="icon_telephone" name="studentEmail" type="email" class="validate" value="<?php echo $user->email; ?>">
                <label for="icon_telephone">Email</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col l8">
                <i class="material-icons prefix">face</i>
                <label>Gender</label>
                    <div class="row">
                        <br>
                    </div>

                     <input value="1"  id="test1" name="male" type="radio"  <?php if (isset($user->gender) && $user->gender==0) echo "checked";?> />
                     <label for="test1">Male</label>


                    <input value="0"  id="test2" name="male" type="radio"  <?php if (isset($user->gender) && $user->gender==1) echo "checked";?>/>
                    <label for="test2">Female</label>

            </div>
        </div>

        <div class="row">
            <div class="input-field col l8">
                <i class="material-icons prefix">language</i>
                <select name="country">
                    <option value="" disabled <?php if (empty($user->country)) echo "selected";?>>Choose your country</option>
                    <option value="ISmaliah" <?php if (isset($user->country) && $user->country=="ISmaliah") echo "selected";?>>ISmaliah</option>
                    <option value="Cairo" <?php if (isset($user->country) && $user->country=="Cairo") echo "selected";?>>Cairo</option>
                    <option value="Portsaid" <?php if (isset($user->country) && $user->country=="Portsaid") echo "selected";?>>Portsaid</option>
                </select>

            </div>
        </div>

        <div class="row">
            <form class="col s6">
                <div class="row">
                    <div class="input-field col l8">
                        <i class="material-icons prefix">mode_edit</i>
                        <textarea id="icon_prefix2" name="studentSignature" class="materialize-textarea"><?php echo $user->signature; ?></textarea>
                        <label for="icon_prefix2">Signature</label>
                    </div>
                </div>
            </form>
        </div>


        <div class="row">
            <div class="input-field col s6 offset-l3">

                <input name="edit" type="submit" class="waves-effect waves-light btn red">

            </div>
        </div>

      </div>
<?php ?>

    <div class="col l4">
        <div class="row">
            <br>
        </div>
        <div class="row">
            <br>
        </div>

        <div class="col s6 l6">
            <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row">
                    <div class="col s12">
                        <img src="<?php echo '/lms';if (!empty($user->picture)){ echo $user->picture;}else {echo '/uploads/images.png'; }?>"  class="circle responsive-img" > <!-- notice the "circle" class -->
                    </div>

                    <div class="row">
                        <br>
                    </div>

                    <div class="col s6 m8 offset-m2 l6">
                    <div class="row">
                        <div class="file-field input-field">
                            <div class="file-field input-field">
                                <div class="btn red">
                                    <span>Edit Picture</span>
                                    <input name="browsePicture" type="file" accept="image/*" />
                                </div>
                                <div class="file-path-wrapper center-align">
                                    <input class="file-path validate " type="text">
                                </div>
                            </div>

                        </div>

                    </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </form>

</div>
<script>

    $(document).ready(function() {
        $('select').material_select();
    });



</script>
<?php

include "footer.php";
?>
