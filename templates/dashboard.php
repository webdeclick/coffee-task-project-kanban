<?php include 'base/header.php'; ?>

<?php include 'elements/apierror.php'; ?>


<div id="categories-list" class="categories-list categories-list-loading">

</div>







<script id="template-category" class="component-template" type="text/template">

    <div id="category-{{ id }}" class="component-category category-color-{{ color }}" data-id="{{ id }}">

        titre : {{ &title }}

        <div class="category-tasks-container">

            Chargement des taches...

        </div>

    </div>

</script>


<script id="template-task" class="component-template" type="text/template">

    <div id="task-{{ id }}" class="component-task" data-id="{{ id }}">

        {{ &title }}

        {{ &description }}

        admin: asigné à : {{ user_asigned.fullname }}



    </div>

</script>



<?php include 'base/footer.php'; ?>
