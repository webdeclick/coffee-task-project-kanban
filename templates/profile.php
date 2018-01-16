<?php include 'base/header.php'; ?>


<?php include 'elements/errors.php'; ?>



<?php

foreach($projects as $project):

    // est admin :
    if $project['xisPermissionAdmin']

    // est modo :
    if $project['xisPermissionManager']

    // nb taches perso :
    $project 'tasks_self'

    // nb taches total :
    $project 'tasks_total'

    
endforeach;


?>






<form action="/profile/update" method="post" enctype="multipart/form-data">>

    <label>fullname</label>
    <input type="text" name="fullname">

    <label>email</label>
    <input type="text" name="email">


    <img src="/avatar/<?php echo $userId; ?>" />

    <label>Avatar</label>
    <input type="file" name="avatar" accept="image/*">


    <label>Password</label>
    <input type="password" name="password">

    <label>Password 2</label>
    <input type="password" name="password2">


    <button type="submit">valider</button>

</form>




<?php include 'base/footer.php'; ?>
