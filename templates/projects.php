<?php include 'base/header.php'; ?>

<?php include 'elements/apierror.php'; ?>


<div id="projects-list">




</div>



<script id="template-project" class="component-template" type="text/template">

    <div id="project-{{ id }}" class="component-project" data-id="{{ id }}">

        {{title}}

        {{ description }}

        {{ #users : user }}
            {{ user }}
        {{/}}

        <button class="project-delete">Supprimer</button>

    </div>

</script>

<?php include 'base/footer.php'; ?>
