<?php include 'base/header.php'; ?>
<?php include 'elements/errors.php'; ?>

<div class="profil-header">
</div>
<div class="left">
    <div class="photo-left">
        <img class="photo" src="<?php echo $avatar_url?>"/>
    </div>
    <h4 class="name"><?php echo $user["fullname"]; ?></h4>
    <p class="info">Inscrit le <?php echo $user["created_at"]?></p>
    <p class="info"><?php echo $user["email"]?></p>
    <p><i class="fa fa-phone-square text_main_green" aria-hidden="true"></i><?php echo $user["phone_number"]?> <p>
    <p><i class="fa fa-home text_main_green" aria-hidden="true"></i><?php echo $user["address"]?> <p>
    <p><i class="fa fa-user text_main_green" aria-hidden="true"></i><?php echo $user["age"]?> <p>
</div>
<div class="wrapper">
<h2 class="text_main_green">Projets en cours:</h2>
</div>
<div class="wrapper">
    <div class="profil_project_wrap">
        <?php
            foreach($projects as $project){?>
                <div>
                    <a href="#" class="project_card">
                        <div class="thumb" style="background-image: url(/img/project-bg-<?php echo $project["id"] % 10?>.png);"></div>
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

<?php include 'base/footer.php'; ?>