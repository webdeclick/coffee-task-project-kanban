<?php include 'base/header.php'; ?>
<?php include 'elements/apisnackbar.php'; ?>
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>        


<script>
    $(document).ready(function() {
        $('#editform').click(function() {
            $("#profilform").slideDown(500);
            $("#editform").slideUp(100);
        });
    });
</script>

<div class="profil-header"></div>

<div class="left">

    <div class="photo-left">
        <img class="photo" src="<?php echo $avatar_url?>"/>
    </div>

    <h4 class="name"><?php echo $user["fullname"]; ?></h4>
    <p class="info">Inscrit le <?php echo $user["created_at"]?></p>
    <p class="info"><?php echo $user["email"]?></p><br>
    <p class="info"><i class="fa fa-phone-square text_main_green profil_icon" aria-hidden="true"></i><?php echo $user["phone_number"]?:"Numéro non renseigné" ?> <p>
    <p class="info"><i class="fa fa-home text_main_green profil_icon" aria-hidden="true"></i><?php echo $user["fonction"]?:"Adresse non renseignée"?> <p>
    <p class="info"><i class="fa fa-user text_main_green profil_icon" aria-hidden="true"></i><?php echo $user["age"]?:"Âge non renseigné"?> <p>
    <a href="#profilform" id="editform" class="text_main_green"><i class="fa fa-edit profil_icon" aria-hidden="true"></i>Modifier le profil</a>
    <?php if (isset($messages)) {?>
        <script> $( document ).ready(function() {jssnackbar('Profil mis à jour.')});</script>
    <?php } ?>

    <div id="profilform" style="display:none;">
        <div class="contactTitle">
	        <h1 class="h1Contact">Modifier le profil</h2>
	        <hr class="hrContact">
        </div>

        <form action="/profile/update" method="post" enctype="multipart/form-data">
            <div class="colGauche" style='margin-left:0px;'>	
                <img class="profil_photo_preview" src="/avatar/<?php echo $userId; ?>" />
                <label class="label_contact">Modifier l'image de profil</label>
                <input class="input_contact" type="file" name="avatar" accept="image/*" value="Fichier">
            </div>
            <div class="colDroit">
                <input class="input_contact" type="text" name="fullname" placeholder="Nom complet">  
                <input  class="input_contact" type="text" name="fonction"placeholder="Fonction" >
                <input  class="input_contact" type="text" name="phone" placeholder="Téléphone">
                <input  class="input_contact" type="text" name="age" placeholder="Âge">
                <input class="label_contact" type="password" name="password" placeholder="password">
                <input class="label_contact" type="password" name="password2" placeholder="password">
                <button class="profil_button_contact" type="submit">Valider les informations</button>
            </div>
        </form>    
    </div>
</div>


<?php include 'base/footer.php'; ?>