'use strict';


var events = {
    'addProject': 'addProjectEvent',
    'updateProject': 'updateProjectEvent',
    'deleteProject': 'deleteProjectEvent',
};

// main :

(function( win, doc ) { 

    // load projects list

    window.addEventListener('load', function( event ) {
    
        // lsit of tiems

        var categoryList = document.getElementById('projects-list');





        var successHandler = function( category )
        {

        }
        
        var errorHandler = function( status )
        {
            error('Impossible de récupérer les projets', status);
        }


        AjaxSimple('GET', apiEndPoint+'projects/list', successHandler, errorHandler);






    });











    function populateCategoriesList( categories )
    {
        if( !empty(categories) )
        {
            loop( categories, function( category )
            {
                var type = category.type;

                var id = category.id;
                var title = category.title;
                var deleted = category.deleted;
            });
        }
        else
        {
            addPlaceholder(categoryList, 'Il n\'y a aucunes catégories, créer-en !');
        }
    }
        
})(this, document);




function addProjectEvent( event )
{

}

function updateProjectEvent( event )
{

}

function deleteProjectEvent( event )
{

}
