<?php include 'base/header.php'; ?>

<?php include 'elements/apierror.php'; ?>


<h2 class="page-title">MES PROJETS</h2>

<div id="projects-list" class="projects-list projects-list-loading">
    <!-- Chargement des projets... -->
    <div class="loader"></div>
</div>


<script id="template-project-new" class="component-template" type="text/template">

    <div id="project-new" class="component-project component-project-new">

        <form id="form-project-new" method="post" action="">

            <div class="project-create-title">
                Créer un projet :
            </div>

            <input placeholder="Titre" id="project-new-title" name="title" type="text">

            <textarea placeholder="Description" id="project-new-description" name="description"></textarea>

            <textarea placeholder="Liste d'utilisateurs (emails)" id="project-new-users" name="users"></textarea>

            <input placeholder="Modérateur (email)" id="project-new-manager" name="manager" type="text">

            <button type="submit" class="project-create">Créer</button>

        </form>

    </div>

</script>


<script id="template-project" class="component-template" type="text/template">

    <div id="project-{{ id }}" class="component-project" data-id="{{ id }}">

        <a href="/dashboard/{{ id }}" class="project-header" {{ ?background_url }} style="background-image: url({{ background_url }})"{{ / }}>
            <div class="project-title">{{ &title }}</div>
        </a>

        {{ ?description }}
            <div class="project-description">
                {{ &description }}
            </div>
        {{ / }}


        <div class="project-dropdown dropdown" tabindex="1">
            <label class="" for="check-dropdown{{ id }}">PROJET</label>
            <div class="dropdown-menu project-status">

                <div class="connector"></div>

                {{ ?user_admin }}
                    <div class="project-action">
                        <div class="project-action-title">Administrateur :</div>
                        - {{ user_admin.fullname }}
                    </div>
                {{ / }}

                {{ ?user_manager }}
                    <div class="project-action">
                        <div class="project-action-title">Modérateur :</div>
                        - {{ user_manager.fullname }}
                    </div>
                {{ / }}

                {{ ?users }}
                    <div class="project-action">
                        <div class="project-action-title">Utilisateurs :</div>
                        {{ #users : user }}
                            <div id="project-{{ id }}-user-{{ user.id }}" data-id="{{ user.id }}">
                                - {{ user.fullname }}
                            </div>
                        {{ / }}
                    </div>
                {{ / }}

                {{ ?xisPermissionAdmin }}
                    <div class="project-action">Admin: <a href="/photos-folder/{{ id }}">Voir les photos</a></div>
                {{ / }}

            </div>

        </div>

        
        

        

        {{ ?xisPermissionAdmin }}
            <a class="project-delete">&times;</a>
        {{ / }}
    </div>

</script>



<?php include 'elements/apisnackbar.php'; ?>

<?php include 'base/footer.php'; ?>
