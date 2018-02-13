<?php include 'base/header.php'; ?>

<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>        

<?php include 'elements/errors.php'; ?>
<script>
$(document).ready(function() {
    $('#editform').click(function() {
  $("#profilform").slideDown(500);
    });
   });
</script>

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
    <a href="#" id="editform"><i class="fa fa-pen" aria-hidden="true"></i>Modifier le profil</a>
    <div id="profilform">

    <div class="contactTitle">
	<h1 class="h1Contact">Modifier le profil</h2>
	<hr class="hrContact">

</div>

<div class="colGauche">	
	<h3 class="h3Contact">Avatar</h3>
	<img src="/avatar/<?php echo $userId; ?>" />
</div>

<div class="colDroit">
<form action="/profile/update" method="post" enctype="multipart/form-data">
<div class="colonne1">
    <label class="label_contact">Nom</label>
    <input class="input_contact" type="text" name="name" required>
    
    <label class="label_contact">Prénom</label>
    <input class="input_contact" type="text" name="surname" required>

    <label class="label_contact">Email</label>
    <input  class="input_contact" type="email" name="mail" required><br>
</div>

 <div class="colonne2">
    <label class="label_contact">Numéro de téléphone</b></label>
    <input class="input_contact" type="tel" name="telephone" required><br>
    
    <label class="label_contact">Ville</b></label>
    <input class="input_contact" type="text" name="city" required><br>
	
   <label class="label_contact">Objet</b></label>
    <input class="input_contact" type="text" name="object" required><br>

</div>
      <div class="colonne3">   
    <label class="label_contact">Votre message</label> 
    <textarea class="textareaContact" name="message"></textarea>  
		  </div>
    <button class="button_contact" type="submit">Envoyer</button>

</form>
</div>

    </div>
</div>

<div class="wrapper">
<h3 class="name">Projets en cours:</h3>
</div>
<div class="wrapper">
    <div class="profil_project_wrap">
        <?php
            foreach($projects as $project){?>
                <div>
                    <a href="#" class="project_card">
                        <div class="thumb" style="background-image: url(/img/project-bg-<?php echo ($project["id"] % 10)?>.png);"></div>
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