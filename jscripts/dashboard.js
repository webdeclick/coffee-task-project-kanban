'use strict';

// main :

(function( win, doc ) {

    var projectId = dashboard.projectId;

    var categoriesList;


    window.addEventListener('load', function( event ) {

        categoriesList = document.getElementById('categories-list');



        // load categories and tasks

        populateCategoriesAndTasksList();
    });

    
    








    function populateCategoriesAndTasksList() {
        
        categoriesList.classList.add('categories-list-loading');

        var successHandler = function( response ) {

            categoriesList.innerHTML = '';
            categoriesList.classList.remove('categories-list-loading');

            var categories = response.categories;

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

                var tasks = response.tasks;

                for( var id in tasks ) {

                    var task = tasks[id];

                    appendTemplate('task', categoryList, task);
                }
            };

            var errorHandler = function( status, exception ) {
                error('Impossible de récupérer les taches de la catégorie ('+categoryId+')', status);
            };

            AjaxSimple('GET', api.endPoint+'project/'+projectId+'/category/'+categoryId+'/tasks/list', successHandler, errorHandler);
        }
    }



    function addtaskEvent( event ) {
    
    }
    
    function updateTaskEvent( event ) {
    
    }
    
    function deleteTaskEvent( event ) {
    
    }
        
})(this, document);






