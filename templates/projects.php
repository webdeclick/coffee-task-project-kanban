<?php include 'base/header.php'; ?>

<?php include 'elements/apierror.php'; ?>


<h2 class="page-title">MES PROJETS</h2>

<div id="projects-list" class="projects-list projects-list-loading">
    <!-- Chargement des projets... -->
    <div class="loader"></div>
</div>






<div id="form-project-new" class="component-project component-project-new">

    <h2>Créer un nouveau</h2>

    <form id="project-new-form" method="POST" action="">

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








<script id="template-project-new" class="component-template" type="text/template">

    <div id="project-new" class="component-project component-project-new">

    </div>

</script>


<script id="template-project" class="component-template" type="text/template">

    <div id="project-{{ id }}" class="component-project" data-id="{{ id }}">

        {{ &title }}

        <br><br>

        {{ &description }}

        <br><br>


        {{ ?user_admin }}
            Administrateur : {{ user_admin.fullname }} <br>
        {{ / }}


        {{ ?user_manager }}
            Modérateur : {{ user_manager.fullname }}  <br>
        {{ / }}


        Utilisateurs :

        {{ #users : user }}

            <div id="project-{{ id }}-user-{{ user.id }}" data-id="{{ user.id }}">
                {{ user.fullname }}
            </div>

        {{ / }}


        {{ ?xisPermissionAdmin }}
            <button class="project-delete">Supprimer</button>
        {{ / }}

        
        <a href="/photos-folder/{{ id }}">Voir les photos</a>

        <a href="/dashboard/{{ id }}">Aller à la liste des taches</a>

    </div>

</script>


<?php include 'base/footer.php'; ?>
