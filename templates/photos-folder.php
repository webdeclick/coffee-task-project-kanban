<?php include 'base/header.php'; ?>

<?php include 'elements/apierror.php'; ?>



<div id="photos-list" class="photos-list photos-list-loading">
    Chargement des photos...
</div>









<script id="template-photos-folder" class="component-template" type="text/template">

    <div id="folder-{{ task_id }}" class="component-folder" data-id="{{ task_id }}">

        TACHE : {{ &title }}<br>

        DESCRIPTION : {{ &description }}<br>

        assigné : {{ user_fullname }}<br>

        Complété ? {{ ?is_completed }}oui{{/}}<br>


        {{ #files : file }}

            <div id="photo-{{ file.id }}" class="component-photo">
                <div>
                    <img src="{{ file.photo_url }}" />
                </div>
                <div>
                    <button class="photo-action" data-state="delete" data-id="{{ file.id }}">Supprimer</button>
                    <button class="photo-action" data-state="validate" data-id="{{ file.id }}">Valider</button>
                </div>
            </div>

        {{/}}

    </div>

</script>

<?php include 'base/footer.php'; ?>
