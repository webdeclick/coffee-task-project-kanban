<?php include 'base/header.php'; ?>

<?php include 'elements/apierror.php'; ?>



<h2 class="page-title">
    <div>Projet : <?php echo $dashboard->title; ?></div>
    
    <div class="page-title-onside">
        <?php if($project_admin): ?>
            <div class="project-admin">Administrateur : <?php echo $project_admin->fullname; ?></div>
        <?php endif; ?>

        <?php if($is_admin || $is_manager): ?>

            <div id="category-create-block">

                <a class="button-category-create-popover" data-category="new">Ajouter une catégorie</a> 

                <div id="category-popover-new" class="component-category-popover ha-popover">
                    <div class="connector"></div>

                    <div class="category-create-title">
                        Ajouter une catégorie :
                    </div>

                    <form id="form-category-create" class="ha-popover-form" method="post">
                        <input placeholder="Titre" id="category-field-title" name="title" type="text"> 

                        <!-- <button class="button-category-cancel ha-button">Annuler</button> -->
                        <button class="button-category-create ha-button">Valider</button>
                    </form>
                </div>

            </div>

        <?php endif; ?>

        <!-- <input name="keyword" placeholder="Keyword" type="text" class="dashboard-search-field">
        <button class="dashboard-search button">Recherche</button>  -->
        <div id="dashboard-search-dropdown" class="select dashboard-search-dropdown" tabindex="1">
            <input class="selectopt" name="filter" type="radio" id="dashboard-search-dropdown-none" value="0" checked>
            <label for="dashboard-search-dropdown-none" class="option">Sans filtre</label>

            <input class="selectopt" name="filter" type="radio" id="dashboard-search-dropdown-archive" value="archive">
            <label for="dashboard-search-dropdown-archive" class="option">Complétés</label>

            <input class="selectopt" name="filter" type="radio" id="dashboard-search-dropdown-olddate" value="olddate">
            <label for="dashboard-search-dropdown-olddate" class="option">Date passée</label>

            <input class="selectopt" name="filter" type="radio" id="dashboard-search-dropdown-delete" value="delete">
            <label for="dashboard-search-dropdown-delete" class="option">Supprimés</label>
        </div>

    </div>
</h2>






<div id="categories-list" class="categories-list categories-list-loading">
    <div class="loader"></div>
</div>








<div id="modal-popup" class="cd-popup" role="alert">

	<div class="cd-popup-container">

        <form method="post" class="newtask-form" enctype="multipart/form-data">

            <div class="cd-popup-header">
                <div>
                    Créer une nouvelle tâche
                </div>
                <div>
                    <a href="#" class="cd-popup-close">Close</a>
                </div>
            </div>

            <div class="cd-popup-content">

                Titre :

                <input name="title" placeholder="Titre" type="text" class="newtask-field-title">

                description :

                <textarea name="description" class="newtask-field-description"></textarea>

                <label for="newtask-showhide-datetimepicker">Date de fin ?</label>
                <input type="checkbox" name="datetimepicker" id="newtask-showhide-datetimepicker">

                <div class="module-datetimepicker-container"></div>
                <input name="end-at" type="hidden" class="module-datetimepicker newtask-field-end-at">

                Assigner à : 

                <div class="select newtask-field-assigned-to" tabindex="1">
                    <input class="selectopt" name="people" type="radio" id="newtask-people-0" value="0" checked>
                    <label for="newtask-people-0" class="option">Moi</label>
                    <!-- +peoples -->
                </div>

                Ajouter des images ( attent de validation par admin )

                <input name="files" id="newtask-field-files" type="file" accept="image/*" multiple>

                <div id="new-task-progress" class="progress-bar">
                    <div class="percentage"></div>
                </div>

            </div>
            
            <div class="cd-buttons">
                <button class="cd-button cd-button-quit">Annuler</button>
                <button class="cd-button cd-button-confirm" type="submit" value="submit">Valider</button>
            </div>

        </form>

    </div> <!-- popup -->

</div> <!-- screen -->


<script id="template-category" class="component-template" type="text/template">

    <div id="category-{{ id }}" class="component-category category-color-{{ color }}" data-id="{{ id }}">

        <div class="category-header">
            <div class="category-icon"></div>
            <div class="category-title category-field-title">{{ &title }}</div>

            <div class="category-dropdown dropdown" tabindex="1">
                <!-- <input class="dropdown-check" id="check-dropdown{{ id }}" type="checkbox"> -->
                <label class="category-menu" for="check-dropdown{{ id }}"></label>
                <div class="category-menu-panel dropdown-menu">
                    <a class="category-menu-item button-category-edit-popover" data-category="{{ id }}">Editer</a>
                    <a class="category-menu-item button-category-delete" data-category="{{ id }}">Supprimer</a> 
                </div>
            </div>
        </div>




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
            <!-- Chargement des taches -->
            <div class="loader"></div>
        </div>

        <div class="category-tasks-addbutton-container component-task">
            <button class="button-task-create-oncategory" data-category="{{ id }}"></button>
        </div>

    </div>

</script>


<script id="template-task" class="component-template" type="text/template">

    <div id="task-{{ id }}" class="component-task" data-id="{{ id }}">

        <div class="task-inner {{ expire_class }}">

            <input class="check-expanded" id="check-task{{ id }}" type="checkbox" />

            <div class="task-title">
                {{ &title }}
            </div>

            <div class="task-description">
                {{ &description }}
            </div>

            <div class="task-content expanded">
                {{ ?files_url }}
                    <div class="task-photos">
                    {{ #files_url : file_url }}
                        <img class="task-photo" src="{{ file_url }}" />
                    {{/}}
                    </div>
                {{/}}

                <div class="task-separator"></div>

                <div class="task-details-block">
                    <div class="task-details">
                        Début: {{ pretty_created_at }}
                        {{ ?pretty_end_at }}
                            <br/>
                            Fin: {{ pretty_end_at }}
                        {{/}}
                    </div>
                    <div class="task-actions">
                        {{ !is_completed }}
                            <button class="button-task-complete" data-id="{{ id }}"></button>
                        {{/}}

                        {{ !is_deleted }}
                            <button class="button-task-delete" data-id="{{ id }}"></button>
                        {{/}}
                    </div>
                </div>

            </div>

            <div class="task-footer">
                <div class="task-calendar"> </div>

                <label class="task-dropdown expander" for="check-task{{ id }}">détails</label>
            </div>

            <!-- {{ ?xisPermissionSeeAll }}
                ADMIN VOIT TOUT

                {{ ?avatar_url }}
                    utilisateur : <img src="{{ avatar_url }}" />
                {{/}}
            {{/}} -->
        
        </div><!--inner-->
    
        <!-- <button class="button-task-edit-show" data-id="{{ id }}">Editer</button> -->
    </div>

</script>


<script id="template-people-list-element" class="component-template" type="text/template">

    <input class="selectopt" name="people" type="radio" id="newtask-people-{{ id }}" value="{{ id }}">
    <label for="newtask-people-{{ id }}" class="option">{{ &fullname }}</label>

</script>







<?php include 'elements/apisnackbar.php'; ?>

<?php include 'base/footer.php'; ?>
