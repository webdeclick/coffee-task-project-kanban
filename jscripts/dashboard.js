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

    });





    function initializePopupCreateButton() {

        popupScreen = document.querySelector('.cd-popup');
        popupContainer = popupScreen.querySelector('.cd-popup-container');

        // open modal ; via create buttons on categories list
        delegate(categoriesList, '.category-tasks-createbutton', 'click', function(event){
            event.preventDefault();
            
            popupScreen.classList.add('is-visible');
            isPopupOpen = true;
            
            var target = event.target;

            var categoryId = target.getAttribute('data-category');
            popupContainer.setAttribute('data-category', categoryId);



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





        });



        document.addEventListener('keydown', function( event ){ //close popup clicking ; esc keyboard
            
            if( isPopupOpen ) {

                var keyCode = event.which || event.keyCode || 0;
                
                if( event.key == 'Escape' || keyCode == 27 ) { // esc
                    popupScreen.classList.remove('is-visible');

                    isPopupOpen = true;
                }
            }
        });
    }


    function populateCategoriesAndTasksList() {
        
        categoriesList.classList.add('categories-list-loading');

        var successHandler = function( response ) {

            categoriesList.innerHTML = '';
            categoriesList.classList.remove('categories-list-loading');

            var categories = response.categories || [];

            for( var id in categories ) {

                var category = categories[id];

                appendTemplate('category', categoriesList, category);

                populateTasksList(id);
            }
        };

        var errorHandler = function( status, exception ) {
            error('Impossible de récupérer les catégories', status);
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
                error('Impossible de récupérer les taches de la catégorie ('+categoryId+')', status);
            };

            AjaxSimple('GET', api.endPoint+'project/'+projectId+'/category/'+categoryId+'/tasks/list', successHandler, errorHandler);
        }
    }











    function updateTaskEvent( event ) {
    
    }
    
    function deleteTaskEvent( event ) {
    
    }
        
})(this, document);
