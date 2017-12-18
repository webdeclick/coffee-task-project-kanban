<?php include 'base/header.php'; ?>

<?php include 'elements/apierror.php'; ?>





<div id="photos-list" class="photos-list photos-list-loading">
    Chargement des photos...
</div>












<script id="template-photos" class="component-template" type="text/template">

    <div id="photos-{{ id }}" class="component-photos" data-id="{{ id }}">


    </div>

</script>

<?php include 'base/footer.php'; ?>
