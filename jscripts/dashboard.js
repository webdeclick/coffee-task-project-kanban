'use strict';

// main :

(function( win, doc ) {

    var projectId = dashboard.projectId;

    var categoriesList;

    var popupScreen, popupContainer, isPopupOpen = false;


    window.addEventListener('load', function( event ) {

        categoriesList = document.getElementById('categories-list');

        // load categories and tasks

        populateCategoriesAndTasksList();

        // initialize create task popup

        initializePopupCreateButton();

        // populate all the peoples linked to project ; for popup create

        populatePeoplesList();
    });





    function initializePopupCreateButton() {

        popupScreen = document.querySelector('.cd-popup');
        popupContainer = popupScreen.querySelector('.cd-popup-container');

        // initialize date time picker

        var datetimePicker = popupContainer.querySelector('.module-datetimepicker');
        // var datetimePickerContainer = popupContainer.querySelector('.module-datetimepicker-container');

        DatetimePickerSimple(datetimePicker, {
            appendTo: popupScreen,
            autoClose: true,
            date: true,
            dayFormat: 'DD',
            inputFormat: 'YYYY-MM-DD HH:mm',
            time: true,
            timeFormat: 'HH:mm',
            min: new Date(),//'2017-10-31',
            // styles: { container: 'rd-container' }
        });

        // open modal ; via create buttons on categories list

        delegate(categoriesList, '.category-tasks-createbutton', 'click', function( event ){
            event.preventDefault();
            
            popupScreen.classList.add('is-visible');
            isPopupOpen = true;

            var target = event.target;

            var categoryId = target.getAttribute('data-category');
            popupContainer.setAttribute('data-category', categoryId);


            // clear previous inputs if any :

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

            var successHandler = function( response ) {
                
                // close modal
                popupScreen.classList.remove('is-visible');
                
                isPopupOpen = false;

                // append task to the list

                if( user.id == data.assigned_to ) {

                }

                // var categoryList = document.querySelector('#category-'+categoryId+' .category-tasks-container');
                // appendTemplate('task', categoryList, task);

                // notification
                jssnackbar('Tâche créée! (AMODIFIER)');


                

                // categoriesList.innerHTML = '';
                // categoriesList.classList.remove('categories-list-loading');
    
                // for( var index in response ) {
    
                //     var category = response[index];
                //     var categoryId = category.id;
    
                //     appendTemplate('category', categoriesList, category);
    
                //     populateTasksList(categoryId);
                // }
            };
    
            var errorHandler = function( status, exception ) {
                // jserror('Impossible de créer cette tâche', status);
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

            var successHandler = function( response ) {

                categoryList.innerHTML = '';

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










    function updateTaskEvent( event ) {
    
    }
    
    function deleteTaskEvent( event ) {
    
    }
        
})(this, document);
