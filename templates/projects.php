<?php include 'base/header.php'; ?>

<?php include 'elements/apierror.php'; ?>





<div id="projects-list" class="projects-list projects-list-loading">
    Chargement des projets...
</div>





<div id="project-new" class="component-project component-project-new">

    <h2>Créer un nouvea</h2>

    <form id="project-new-form" method="" action="">

        titre :
        <input id="project-new-title" name="title" type="text">

        desc :
        <textarea id="project-new-description" name="description"></textarea>

        users : un email par ligne
        <textarea id="project-new-users" name="users"></textarea>

        modérateur : (email)
        <input id="project-new-manager" name="manager" type="text">


        <button type="submit" class="project-create">Créer</button>

    </form>

</div>





<script id="template-project" class="component-template" type="text/template">

    <div id="project-{{ id }}" class="component-project" data-id="{{ id }}">

        {{ &title }}

        {{ &description }}


        {{ ?user_admin }}
            Administrateur : {{ user_admin.fullname }}
        {{ / }}


        {{ ?user_manager }}
            Modérateur : {{ user_manager.fullname }}
        {{ / }}


        Utilisateurs :

        {{ #users : user }}

            <div id="user-{{ user.id }}" data-id="{{ user.id }}">
                {{ user.fullname }}
            </div>

        {{ / }}


        {{ ?xisPermissionAdmin }}
            <button class="project-delete">Supprimer</button>
        {{ / }}


        <a href="/dashboard/{{ id }}">Aller à la liste des taches</a>

    </div>

</script>

<?php include 'base/footer.php'; ?>
