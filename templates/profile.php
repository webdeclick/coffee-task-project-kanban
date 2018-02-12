<?php include 'base/header.php'; ?>
<?php include 'elements/errors.php'; ?>

<div class="wrapper">
    <div>   
        <div class="profil_form"></div>
    </div>

    <div>
        <h2>Projets en cours:</h2>
        
        <div class="profil_project_wrap">
            <?php
                foreach($projects as $project){?>
                    <div>
                        <a href="/dashboard/<?php echo $project["id"]?>" class="project_card">
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
</div>

<script type="text/javascript" src="/jscripts/profil_update.js"></script>

<?php include 'base/footer.php'; ?>
