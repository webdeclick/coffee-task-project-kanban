<?php include 'base/header.php'; ?>


<section class="homepage-why">

    <div class="homepage-desk">
        <img src="/img/homepage-desk.jpg" alt="">
    </div>

    <div class="homepage-panel">
        <h2 class="homepage-text-title">
            Simplement travailler ensemble
        </h2>

        <div class="homepage-text-desc">
            Créez un projet, ajoutez des membres à votre équipe, et commencer à assignez des tâches. La gestion d'équipe n'a jamais été plus simple et intuitive! 
        </div>

        <div class="perso-container">
            <?php if( $isLogged ): ?>
                <a href="/projects" class="button">Voir mes projets</a>
            <?php else: ?>
                <a href="/login" class="button">Connexion</a> - <a href="/register">Inscription</a>
            <?php endif; ?>
        </div>
    </div>

</section>

<section class="homepage-why">

    <div class="homepage-panel">
        <h2 class="homepage-text-title">
            Futé, agile et visuel
        </h2>

        <div class="homepage-text-desc">
            Simple d'apparence, les tuiles ont tout ce dont vous avez besoin pour vous organiser et ne vous ennuieront jamais avec des fonctionnalités inutiles.
        </div>

        <div class="perso-container">
            <?php if( $isLogged ): ?>
                <a href="/projects" class="button">Voir mes projets</a>
            <?php else: ?>
                <a href="/login" class="button">Connexion</a> - <a href="/register">Inscription</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="homepage-desk">
        <img src="/img/homepage-jessica.jpg" alt="">
    </div>

</section>


<?php include 'base/footer.php'; ?>
