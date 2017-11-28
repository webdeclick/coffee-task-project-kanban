<?php include 'base/header.php'; ?>


<?php include 'elements/errors.php'; ?>


<form action="/profile/update" method="post">

    <label>fullname</label>
    <input type="text" name="fullname">

    <label>email</label>
    <input type="text" name="email">



    <label>Password</label>
    <input type="password" name="password">

    <label>Password 2</label>
    <input type="password" name="password2">


    <button type="submit">valider</button>

</form>




<?php include 'base/footer.php'; ?>
