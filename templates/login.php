<?php include 'base/header.php'; ?>




<?php include 'elements/errors.php'; ?>


<form action="/login/validate" method="post">

    <label>email</label>
    <input type="text" name="email" required>

    <label>Password</label>
    <input type="password" name="password" required>


    <button type="submit">Login</button>

</form>




<?php include 'base/footer.php'; ?>
