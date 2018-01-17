<?php include 'base/header.php'; ?>
<?php include 'elements/errors.php'; ?>

<div class="wrapper">
    <div>   
        <div class="profil_picture">
            <img src="https://i.ytimg.com/vi/6FQsIfE7sZM/maxresdefault.jpg" alt="">
        </div>
        <div> 
            <h2 class="text_main_green"><?php echo $user["fullname"]; ?></h2>
            <p class="joined">Inscrit le <?php echo $user["created_at"]?></p><br>
            <p><i class="fa fa-phone-square text_main_green" aria-hidden="true"></i> Téléphone: <?php echo $user["phone_number"]?> <p>
            <p><i class="fa fa-envelope text_main_green" aria-hidden="true"></i> Email: <?php echo $user["email"]?><p>
            <p><i class="fa fa-home text_main_green" aria-hidden="true"></i> Adresse: <?php echo $user["address"]?> <p>
            <p><i class="fa fa-user text_main_green" aria-hidden="true"></i> Âge: <?php echo $user["age"]?> <p>
        </div> 
    </div>

    <div>
        <h2>Projets en cours:</h2>
        <div class="profil_project_wrap">
            <?php
                foreach($projects as $project){?>
                    <div>
                        <a href="#" class="project_card">
                            <div class="thumb" style="background-image: url(http://localhost/img/project-bg-1.png);"></div>
                            <article>
                                <h1><?php echo $project["title"]?></h1>
                                <p><?php echo $project["description"]?></p>
                                <span>
                                    <?php
                                     if ($project['xisPermissionAdmin'])
                                        echo 'Administrateur';
                                    else
                                    if ($project['xisPermissionManager'])  
                                        echo 'Modérateur';
                                    ?>
                                </span>
                            </article>
                        </a>
                    </div>
                <?php } ?>
        </div>
    </div>
</div>



<?php include 'base/footer.php'; ?>
