<?php include 'base/header.php'; ?>

<?php include 'elements/apierror.php'; ?>


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

            Titre : <input placeholder="Titre" type="text">

            description : 

            Date de fin : <input type="text" class="module-datetimepicker">

        </div>
        
        <div class="cd-buttons">
            <button class="cd-button cd-button-quit">Annuler</button>
            <button class="cd-button cd-button-confirm">Valider</button>
        </div>
    </div> <!-- popup -->

</div> <!-- screen -->


<script id="template-category" class="component-template" type="text/template">

    <div id="category-{{ id }}" class="component-category category-color-{{ color }}" data-id="{{ id }}">

        titre : {{ &title }}

        <div class="category-tasks-container">

            Chargement des taches...

        </div>

        <div class="category-tasks-addbutton-container">
            <button class="category-tasks-createbutton" data-category="{{ id }}">Ajouter une tâche</button>
        </div>

    </div>

</script>


<script id="template-task" class="component-template" type="text/template">

    <div id="task-{{ id }}" class="component-task" data-id="{{ id }}">

        {{ &title }}

        {{ &description }}

        date création : {{ created_at }}

    </div>

</script>




<?php include 'elements/apisnackbar.php'; ?>

<?php include 'base/footer.php'; ?>
