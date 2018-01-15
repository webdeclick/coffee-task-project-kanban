<?php include 'base/header.php'; ?>


<div class="divContact">
	<h2>Contact</h2>
	<p>Orientis vero limes in longum protentus et rectum ab Euphratis fluminis ripis ad usque supercilia porrigitur Nili, laeva Saracenis conterminans gentibus, dextra pelagi fragoribus patens, quam plagam Nicator Seleucus occupatam auxit magnum</p>
</div>

<form action="" method="post">

<div class="colDroit">
    <label class="label_contact">Nom - Prénom</label>
    <input class="input_contact" type="text" name="fullnames" required><br>

    <label class="label_contact">Email</label>
    <input  class="input_contact" type="text" name="email" required><br>

    <label class="label_contact">Numéro de téléphone</b></label>
    <input class="input_contact" type="number" name="phone" required><br>
</div>
   
   <div class="colGauche">
    <label class="">Votre message</label>
    <textarea class="" name="msg"></textarea>    
   </div>
    <button class="button_contact" type="submit">Envoyer</button>


</form>

<?php include 'base/footer.php'; ?>
