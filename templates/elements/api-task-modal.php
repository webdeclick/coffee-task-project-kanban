

<div id="modal-popup-task" class="modal-task cd-popup" role="alert">

    <div class="modal-popup-container cd-popup-container">

        <div class="cd-popup-header">
            <a href="#" class="cd-popup-close">Close</a>
        </div>

        <div class="modal-task-container">


        </div>

    </div>

</div>




<script id="template-task-modal" class="component-template" type="text/template">

<div id="task-{{ id }}" class="component-task component-task-modal" data-id="{{ id }}">

    <div class="task-inner {{ expire_class }}">

        <input class="check-expanded" id="modal-check-task{{ id }}" type="checkbox" />

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
                <!--<div class="task-actions">
                    {{ !is_completed }}
                        <button class="button-task-complete" data-id="{{ id }}"></button>
                    {{/}}

                    {{ !is_deleted }}
                        <button class="button-task-delete" data-id="{{ id }}"></button>
                    {{/}}
                </div>-->
            </div>

        </div>

        <div class="task-footer">
            <div class="task-calendar"> </div>

            <label class="task-dropdown expander" for="modal-check-task{{ id }}">détails</label>
        </div>

        <!-- {{ ?xisPermissionSeeAll }}
            ADMIN VOIT TOUT

            {{ ?avatar_url }}
                utilisateur : <img src="{{ avatar_url }}" />
            {{/}}
        {{/}} -->
    
    </div><!--inner-->

</div>

</script>
