<?php include 'base/header.php'; ?>

<h2 class="page-title">Plan du site</h2>

<ul class="sitemap-list">
    <li class="sitemap-item">
        <a href="/">Accueil</a>
    </li>
    <li class="sitemap-item">
        <a href="/mentions">Mentions légales</a>
    </li>
    <li class="sitemap-item">
        <a href="/contact">Contact</a>
    </li>

    <?php if($isLogged): ?>
        <li class="sitemap-item">
            <a href="/profile">Profil</a>
        </li>
        <li class="sitemap-item">
            <a href="/logout">Déconnexion</a>
        </li>
        <li class="sitemap-item">
            <a href="/projects">Tableau De Bord</a>
        </li>

        <?php if(!empty($projects)): ?>
            <ul class="sitemap-list">
                <?php foreach($projects as $project): ?>
                    <li class="sitemap-item">
                        <a href="/dashboard/<?php echo $project['project_id']; ?>"><?php echo $project['title']; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    <?php else: ?>
        <li class="sitemap-item">
            <a href="/login">Connexion</a>
        </li>
        <li class="sitemap-item">
            <a href="/register">Inscription</a>
        </li>

    <?php endif; ?>
</ul>


<?php include 'base/footer.php'; ?>
