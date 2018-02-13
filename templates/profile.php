<?php include 'base/header.php'; ?>
<?php include 'elements/errors.php'; ?>
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
    <p class="info"><?php echo $user["email"]?></p>
    <p><i class="fa fa-phone-square text_main_green" aria-hidden="true"></i><?php echo $user["phone_number"]?> <p>
    <p><i class="fa fa-home text_main_green" aria-hidden="true"></i><?php echo $user["address"]?> <p>
    <p><i class="fa fa-user text_main_green" aria-hidden="true"></i><?php echo $user["age"]?> <p>
    <a href="#" id="editform"><i class="fa fa-pen" aria-hidden="true"></i>Modifier le profil</a>
    
    <div id="profilform" style="display:none;">
        <div class="contactTitle">
	        <h1 class="h1Contact">Modifier le profil</h2>
	        <hr class="hrContact">
        </div>

        <form action="/profile/update" method="post" enctype="multipart/form-data">
            <div class="colGauche" style='margin-left:0px;'>	
                <img class="profil_photo_preview" src="/avatar/<?php echo $userId; ?>" />
                <label class="label_contact">Avatar</label>
                <input class="input_contact" type="file" name="avatar" accept="image/*">
            </div>
            <div class="colDroit">
                <label class="label_contact">Nom complet</label>
                <input class="input_contact" type="text" name="fullname" ><br>
                    
                <label class="label_contact">Email</label>
                <input  class="input_contact" type="email" name="email" ><br>

                <label class="label_contact">Password</label>
                <input class="label_contact" type="password" name="password"><br>
                    
                <label class="label_contact">Password 2</label>
                <input class="label_contact" type="password" name="password2">
                
                <button class="button_contact" type="submit">Valider</button>
            </div>
        </form>    
    </div>
</div>

<?php include 'base/footer.php'; ?>