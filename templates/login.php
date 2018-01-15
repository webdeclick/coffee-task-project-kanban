<?php include 'base/header.php'; ?>




<?php include 'elements/errors.php'; ?>

<div class="position_logo">
<img class="logo_login" src="../img/logo_01.png">
</div>

 <div class="login_form">
   <h1 class="h1_login">Connexion</h1>
<hr>
    <form action="/login/validate" method="post">

    <label class="label_input">Email</label>
    <input class="input_login" type="text" name="email" required>

    <label class="label_input">Mot de passe</label>
    <input class="input_login" type="password" name="password" required>


    <button class="btn_login" type="submit">Connexion</button>

</form>
</div>



<?php include 'base/footer.php'; ?>
