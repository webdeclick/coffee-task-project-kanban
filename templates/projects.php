<?php include 'base/header.php'; ?>

<?php include 'elements/apierror.php'; ?>


<h2 class="page-title">
    <div>
        <a href="#" class="tooltip"><span>
            Au milieu de cette page, vous trouverez vos différents projets (il est normal que vous n’ayez aucun projet lors de votre première connexion).
            <br><br>
            Il est possible de supprimer un projet via la croix rouge au survol d'un projet.
            <br><br>
            Si vous êtes administrateur, n'oubliez pas de valider les photos que les utilisateurs auront uploadé sur les tâches.
        </span></a>
        MES PROJETS
    </div>

    <div id="project-create-block">

        <a class="button-project-create-popover">Ajouter un projet</a> 

        <div id="project-popover-new" class="component-project-popover ha-popover">
            <div class="connector"></div>

            <div class="project-popover-title">
                <a href="#" class="tooltip"><span>
                    Création de projet : Il faudra lui donner un nom, une description et lui assigner des utilisateurs ainsi qu’un modérateur.
                    <br>
                    Conseil : Choisissez un nom logique car ce nom sera utilisé et vu par tous les membres de votre projet.
                    <br>
                    Si vous êtes satisfait de toutes vos informations cliquer sur “Créer”.
                    <br>
                </span></a>

                Ajouter un projet :
            </div>

            <form id="form-project-new" class="component-project-new" method="post" action="">

                <input placeholder="Titre" id="project-new-title" name="title" type="text">

                <textarea placeholder="Description" id="project-new-description" name="description"></textarea>

                <textarea placeholder="Liste d'utilisateurs (emails)" id="project-new-users" name="users"></textarea>

                <input placeholder="Modérateur (email)" id="project-new-manager" name="manager" type="text">

                <footer class="project-popover-new-footer ha-footer">
                    <button class="project-popover-button button-project-cancel">Annuler</button>
                    <button class="project-popover-button button-project-create" type="submit">Créer</button>
                </footer>  

            </form>

        </div>

    </div>
</h2>




<div id="projects-list" class="projects-list projects-list-loading">
    <!-- Chargement des projets... -->
    <div class="loader"></div>
</div>



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

        <input class="check-expanded" id="check-dropdown{{ id }}" type="checkbox" />
        <label class="project-dropdown expander" for="check-dropdown{{ id }}">PROJET</label>
        
        <div class="project-status expanded" tabindex="1"><!--dropdown-menu-->

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


        {{ ?xisPermissionAdmin }}
            <a class="project-delete">&times;</a>
        {{ / }}
    </div>

</script>



<?php include 'elements/apisnackbar.php'; ?>

<?php include 'base/footer.php'; ?>
