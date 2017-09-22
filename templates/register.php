<?php include 'base/header.php'; ?>



<?php include 'elements/errors.php'; ?>


<form action="/register/validate" method="post">

    <label>full name</label>
    <input type="text" name="fullname" required>

    <label>email</label>
    <input type="text" name="email" required>

    <label>Password 1</b></label>
    <input type="password" name="password1" required>

    <label>Password vérif</label>
    <input type="password" name="password2" required>

    <button type="submit">Login</button>


</form>


<?php include 'base/footer.php'; ?>
