<?php include 'base/header.php'; ?>

<div class="mapContact">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1753.3523052176754!2d7.447515779168465!3d46.949255798376136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478e39c143b1e5ab%3A0xfb566a255c854c10!2sKornhauscaf%C3%A9!5e0!3m2!1sfr!2sfr!4v1516088385533" width="100%" height="270" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>

<div class="contactTitle">
	<h1 class="h1Contact">Contact</h2>
	<hr class="hrContact">
	<p class="pContact">Vous pouvez nous contacter par téléphone ou par email et nous vous répondrons dans les plus brefs délais.</p>
</div>

<div class="colGauche">
	
	<h3 class="h3Contact">Notre agence</h3>
	<p class="pContact">Adresse : Kornhauspl. 3011 Bern, Suisse</p>
	<p class="pContact">Téléphone : +41 31 327 72 70</p>
	<p class="pContact">Email : escobar@coffeetask.com</p>
	<i class="fa fa-facebook" aria-hidden="true"></i>
	<i class="fa fa-twitter" aria-hidden="true"></i>
	<i class="fa fa-linkedin" aria-hidden="true"></i>
	<i class="fa fa-google-plus" aria-hidden="true"></i>
</div>

<div class="colDroit">
<h3 class="h3Contact">Contactez-Nous</h3>

<?php if (isset($message)) {
	echo '<div class="fill_main_green"><p class="p_style_contact">Votre message a bien été envoyé !</p></div>';
}  
	?>
<form action="/contact/post" method="post">

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
<?php include 'base/footer.php'; ?>
