<?php include 'base/header.php'; ?>

<?php include 'elements/apierror.php'; ?>


<div id="projects-list" class="projets-list projets-list-loading">

    Chargement des projets...

</div>

<div class="category-create-block">

    <button class="button-category-create-popover" data-category="new">Créer une catégorie</button> 

    <div id="category-popover-new" class="component-category-popover ha-popover">
        <div class="connector"></div>

        <form class="ha-popover-form" method="post">
            <section>    
                <div class="ha-text-field">
                    <label for="category-field-title">Titre :</label>
                    <input id="category-field-title" name="title"  type="text">
                </div>
            </section>    

            <footer class="ha-footer">
                <button class="button-category-cancel ha-button">Annuler</button> 
                <button class="button-category-create ha-button">Valider</button> 
            </footer>
        </form>
    </div>

</div>



<div id="categories-list" class="categories-list categories-list-loading">

    Chargement du tableau de bord...

</div>








<div id="modal-popup" class="cd-popup" role="alert">

	<div class="cd-popup-container">

        <div class="cd-popup-header">
            <div>
                Créer une nouvelle tâche
            </div>
            <div>
                <a href="#" class="cd-popup-close">Close</a>
            </div>
        </div>

        <div class="cd-popup-content">

            <form method="post" class="newtask-form">

                Titre :

                <input name="newtask-field-title" placeholder="Titre" type="text" class="newtask-field-title">

                description :

                <textarea name="newtask-field-description" class="newtask-field-description"></textarea>

                <label for="newtask-showhide-datetimepicker">Date de fin ?</label>
                <input type="checkbox" name="newtask-showhide-datetimepicker" id="newtask-showhide-datetimepicker">

                <div class="module-datetimepicker-container"></div>
                <input name="newtask-field-end-at" type="hidden" class="module-datetimepicker newtask-field-end-at">

                Assigner à : 

                <div class="select newtask-field-assigned-to" tabindex="1">
                    <input class="selectopt" name="newtask-field-people" type="radio" id="newtask-people-0" value="0" checked>
                    <label for="newtask-people-0" class="option">Moi</label>
                    <!-- +peoples -->
                </div>

            </form>

        </div>
        
        <div class="cd-buttons">
            <button class="cd-button cd-button-quit">Annuler</button>
            <button class="cd-button cd-button-confirm">Valider</button>
        </div>
    </div> <!-- popup -->

</div> <!-- screen -->




<script id="template-project" class="component-template" type="text/template">

    <div id="project-{{ id }}" class="component-project">

        <a href="/dashboard/{{ id }}">{{ &title }}  (voir le projet)</a>

        <br>

        description : {{ &description }}

    </div>

</script>


<script id="template-category" class="component-template" type="text/template">

    <div id="category-{{ id }}" class="component-category category-color-{{ color }}" data-id="{{ id }}">

        <div class="category-field-title">
            {{ &title }}
        </div>

        <button class="button-category-edit-popover" data-category="{{ id }}">Editer</button>

        <button class="button-category-delete" data-category="{{ id }}">Supprimer</button> 


        <div id="category-popover-{{ id }}" class="component-category-popover ha-popover">
            <div class="connector"></div>

            <form class="ha-popover-form" action="patch">
                <section>    
                    <div class="ha-text-field">
                        <label for="category-field-title">Titre :</label>
                        <input id="category-field-title" name="title"  type="text">
                    </div>
                </section>    
            
                <footer class="ha-footer">
                    <button class="button-category-cancel ha-button" data-category="{{ id }}">Annuler</button> 
                    <button class="button-category-save ha-button" data-category="{{ id }}">Valider</button> 
                </footer>  

            </form>
        </div>


        <div class="category-tasks-container">

            Chargement des taches...

        </div>

        <div class="category-tasks-addbutton-container">
            <button class="button-task-create-oncategory" data-category="{{ id }}">Ajouter une tâche</button>
        </div>

    </div>

</script>


<script id="template-task" class="component-template" type="text/template">

    <div id="task-{{ id }}" class="component-task" data-id="{{ id }}">

        {{ &title }}

        <br>

        {{ &description }}

        <br>

        date création : {{ created_at }}

        <br>

        {{ ?end_at }}
            date fin : {{ end_at }}
        {{/}}
        
        <button class="button-task-delete" data-category="{{ category_id }}" data-id="{{ id }}">Supprimer</button>



        <button class="button-task-edit-show" data-category="{{ category_id }}" data-id="{{ id }}">Editer</button>

    </div>

</script>


<script id="template-people-list-element" class="component-template" type="text/template">

    <input class="selectopt" name="newtask-field-people" type="radio" id="newtask-people-{{ id }}" value="{{ id }}">
    <label for="newtask-people-{{ id }}" class="option">{{ &fullname }}</label>

</script>







<?php include 'elements/apisnackbar.php'; ?>

<?php include 'base/footer.php'; ?>
