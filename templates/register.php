<?php include 'base/header.php'; ?>



<?php include 'elements/errors.php'; ?>

<div class="logo_reg">
	<img class="logo_register" src="../img/logo_01.png">
</div>

<div class="form_reg">

<form action="/register/validate" method="post">

    <label class="label_input">Nom prénom</label>
    <input class="input_login" type="text" name="fullname" required>

    <label class="label_input">Email</label>
    <input  class="input_login" type="text" name="email" required>

    <label class="label_input">Mot de passe</b></label>
    <input class="input_login" type="password" name="password1" required>

    <label class="label_input">Confirmation du mot de passe</label>
    <input  class="input_login" type="password" name="password2" required>

    <button class="button_reg" type="submit">Je m'inscris</button>


</form>

</div>


<?php include 'base/footer.php'; ?>
