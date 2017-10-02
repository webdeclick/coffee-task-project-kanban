<?php include 'base/header.php'; ?>

<?php include 'elements/apierror.php'; ?>


<div id="projects-list">




</div>




<template id="template-project" class="component-template">

    <div class="component-project">

        {{ title }}

        {{ description }}


        {{ #users > user }}

        {{ /users }}

    </div>

</template>

<?php include 'base/footer.php'; ?>
