<?php include 'base/header.php'; ?>


<?php include 'elements/errors.php'; ?>
<?php echo var_dump($user); ?>

<div class="wrapper">
    <div class="profil_col"> 
        <div class="profil_picture">
        <img src="https://i.ytimg.com/vi/6FQsIfE7sZM/maxresdefault.jpg" alt="">
        </div>
        <div class="profil_projects">
            LISTE DES PROJETS ICI
            <br>
            Query from database 1
            <br>
            Query from database 2
            <br>
            Query from database 3
            <br>
            Query from database 4
            <br>
            Query from database 5
        </div>
    </div>
    <div class="profil_col"> 
        <h2><?php echo $user["fullname"]; ?></h2>
        <p>Description Profil</p>
        <p> Task completed: X</p>
        <button type="">Ajouter au projet</button>
        <h2>Coordonnées</h2>
        <p>Téléphone: FZEFAEFZEF</p>
        <p>Téléphone: FZEFAEFZEF</p>
        <p>Téléphone: FZEFAEFZEF</p>
        <p>Téléphone: FZEFAEFZEF</p>
        <p>Téléphone: FZEFAEFZEF</p>

    </div>
</div>



<!-- <form action="/profile/update" method="post" enctype="multipart/form-data">>

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
 -->



<?php include 'base/footer.php'; ?>
