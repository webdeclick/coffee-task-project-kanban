<?php include 'base/header.php'; ?>

<?php include 'elements/apierror.php'; ?>

<h2 class="page-title">Validation des photos</h2>


<div id="photos-list" class="photos-list photos-list-loading">
    <!-- Chargement des photos... -->
    <div class="loader"></div>
</div>


<script id="template-photos-folder" class="component-template" type="text/template">

    <div id="folder-{{ task_id }}" class="component-folder" data-id="{{ task_id }}">

        <div class="folder-inner {{ expire_class }}">

            <div class="folder-title">
                <div>{{ &title }}</div>
                <div>Assigné à : {{ user_fullname }}</div>
            </div>

            <div class="folder-description">{{ &description }}</div>

            {{ ?files }}
                <div class="photos-container">
                {{ #files : file }}
                    <div id="photo-{{ file.id }}" class="component-photo">
                        <img class="photo-img" src="{{ file.photo_url }}" />
                        <div class="photo-panel">
                            <button class="photo-action" data-state="delete" data-id="{{ file.id }}"></button>
                            <button class="photo-action" data-state="validate" data-id="{{ file.id }}"></button>
                        </div>
                    </div>
                {{/}}
                </div>
            {{/}}

        </div>

    </div>

</script>



<?php include 'elements/apisnackbar.php'; ?>

<?php include 'base/footer.php'; ?>
