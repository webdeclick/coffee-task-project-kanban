'use strict';

// main :

(function( win, doc ) {

    var projectId = dashboard.projectId;
    var userId = user.id;

    var projectsList, categoriesList;

    var popupScreen, popupContainer, isPopupOpen = false;


    window.addEventListener('load', function( event ) {

        projectsList = document.getElementById('projects-list');

        categoriesList = document.getElementById('categories-list');

        // load projects on top

        populateProjects();

        // load categories and tasks

        populateCategoriesAndTasksList();

        // initialize events

        initializeDelegatedEvents();

        // initialize create task popup

        initializePopupCreateButton();

        // populate all the peoples linked to project ; for popup create

        populatePeoplesList();
    });






    function populateProjects()
    {
        projectsList.classList.add('projects-list-loading');

        var successHandler = function( response ) {

            projectsList.innerHTML = '';
            projectsList.classList.remove('projects-list-loading');

            for( var index in response ) {

                var project = response[index];

                appendTemplate('project', projectsList, project);
            }
        };

        var errorHandler = function( status, exception ) {
            jserror('Impossible de récupérer les projets', status);
        };

        AjaxSimple('GET', api.endPoint+'projects/list', successHandler, errorHandler);
    }

    function populateCategoriesAndTasksList() {
        
        categoriesList.classList.add('categories-list-loading');

        var successHandler = function( response ) {

            categoriesList.innerHTML = '';
            categoriesList.classList.remove('categories-list-loading');

            for( var index in response ) {

                var category = response[index];
                var categoryId = category.id;

                appendTemplate('category', categoriesList, category);

                populateTasksList(categoryId);
            }
        };

        var errorHandler = function( status, exception ) {
            jserror('Impossible de récupérer les catégories', status);
        };

        AjaxSimple('GET', api.endPoint+'project/'+projectId+'/categories/list', successHandler, errorHandler);
    }

    function populateTasksList( categoryId ) {

        var categoryList = document.querySelector('#category-'+categoryId+' .category-tasks-container');

        if( categoryList ) {

            categoryList.classList.add('category-loading');

            var successHandler = function( response ) {

                categoryList.innerHTML = '';
                categoryList.classList.remove('category-loading');

                for( var index in response ) {

                    var task = response[index];

                    appendTemplate('task', categoryList, task);
                }
            };

            var errorHandler = function( status, exception ) {
                jserror('Impossible de récupérer les taches de la catégorie ('+categoryId+')', status);
            };

            AjaxSimple('GET', api.endPoint+'project/'+projectId+'/category/'+categoryId+'/tasks/list', successHandler, errorHandler);
        }
    }

    function initializeDelegatedEvents() {

        // delete button task

        delegate(categoriesList, '.button-task-delete', 'click', function( event ){
            event.preventDefault();

            var target = event.target;

            var taskId = target.getAttribute('data-id');
            var categoryId = target.getAttribute('data-category');

            var taskElement = document.getElementById('task-'+taskId);

            if( taskElement ) {

                var confirmDialog = confirm('Supprimer cette tâche ?');

                if( confirmDialog )
                {
                    var successHandler = function( response ) {
                        
                        // notification
                        jssnackbar('Tâche supprimée!');

                        taskElement.remove();
                    };
            
                    var errorHandler = function( status, exception ) {
                        jserror('Impossible de supprimer cette tâche', status);
                    };
            
                    AjaxSimple('DELETE', api.endPoint+'task/'+taskId+'/delete', successHandler, errorHandler);
                
                } //confirm

            } // element exist
        });

    }

    function initializePopupCreateButton() {

        popupScreen = document.querySelector('.cd-popup');
        popupContainer = popupScreen.querySelector('.cd-popup-container');

        // initialize date time picker

        var datetimePicker = popupContainer.querySelector('.module-datetimepicker');
        var datetimePickerContainer = popupContainer.querySelector('.module-datetimepicker-container');

        DatetimePickerSimple(datetimePickerContainer, {
            //appendTo: x,
            autoClose: true,
            date: true,
            dayFormat: 'DD',
            inputFormat: 'YYYY-MM-DD HH:mm:ss',
            time: true,
            timeFormat: 'HH:mm',
            min: new Date(),//today
            // styles: { container: 'rd-container' }
        }).on('data', function( value ) {
            datetimePicker.value = value;
        });

        // open modal ; via create buttons on categories list

        delegate(categoriesList, '.button-task-create-oncategory', 'click', function( event ){
            event.preventDefault();

            popupScreen.classList.add('is-visible');
            isPopupOpen = true;

            var target = event.target;

            var categoryId = target.getAttribute('data-category');
            popupContainer.setAttribute('data-category', categoryId);

            // clear previous inputs if any : @TODO:

        });

        // close modal ; nope button

        delegate(popupScreen, '.cd-popup, .cd-popup-close, .cd-button-quit', 'click', function( event ) {
            event.preventDefault();
     
            popupScreen.classList.remove('is-visible');
            isPopupOpen = false;
        });

        //create button modal

        delegate(popupScreen, '.cd-button-confirm', 'click', function( event ) {
            event.preventDefault();

            // gather form datas

            var categoryId = popupContainer.getAttribute('data-category');

            var form = popupContainer.querySelector('.newtask-form');
            var data = getFormDataJson(form);

            var assignedTo = data['newtask-field-people'];


            var successHandler = function( response ) {

                // close modal
                popupScreen.classList.remove('is-visible');
                
                isPopupOpen = false;

                var newTaskId = response.taskId;

                // notification
                jssnackbar('Tâche créée!');

                // append task to the list ; self

                if( assignedTo == userId || assignedTo == 0 || !assignedTo ) {

                    // quick dirty @fixme
                    populateTasksList(categoryId);
                }
            };
    
            var errorHandler = function( status, exception ) {
                jserror('Impossible de créer cette tâche', status);
            };
    
            AjaxSimple('POST', api.endPoint+'project/'+projectId+'/category/'+categoryId+'/task/create', successHandler, errorHandler, data);
        });

        //close popup clicking ; esc keyboard

        document.addEventListener('keydown', function( event ){ 
            
            if( isPopupOpen ) {

                var keyCode = event.which || event.keyCode || 0;
                
                if( event.key == 'Escape' || keyCode == 27 ) { // esc
                    popupScreen.classList.remove('is-visible');

                    isPopupOpen = false;
                }
            }
        });
    }

    function populatePeoplesList() {

        var peoplesList = document.querySelector('.newtask-field-assigned-to');

        if( peoplesList ) {
            
            var successHandler = function( response ) {

                for( var index in response ) {

                    var people = response[index];

                    appendTemplate('people-list-element', peoplesList, people);
                }
            };

            var errorHandler = function( status, exception ) {
                jserror('Impossible de récupérer les personnes participant au projet ('+projectId+')', status);
            };

            AjaxSimple('GET', api.endPoint+'project/'+projectId+'/peoples/list', successHandler, errorHandler);
        }
    }







        
})(this, document);
