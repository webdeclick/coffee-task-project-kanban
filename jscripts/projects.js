'use strict';

(function( win, doc ) { 

    var categoryList;


    win.addEventListener('load', function( event ) {
    
        categoryList = doc.getElementById('projects-list');

        delegate(categoryList, '.component-project .project-delete', 'click', deleteProjectEvent);



        // load projects list

        var successHandler = function( response )
        {
            var projects = response.projects;

            for( var id in projects ) {
                var project = projects[id];

                appendTemplate('project', categoryList, project);
            }
        };
        
        var errorHandler = function( status, exception )
        {
            error('Impossible de récupérer les projets', status);
        };

        AjaxSimple('GET', api.endPoint+'projects/list', successHandler, errorHandler);
    });

})(this, document);




function addProjectEvent( event )
{
    
}

function updateProjectEvent( event )
{

}

function deleteProjectEvent( event )
{
    var target = event.target;

    var projectBlock = findAncestor(target, '.component-project');

    var projectId = projectBlock.getAttribute('data-id');


    // call ajax delete

    var successHandler = function( response )
    {
        projectBlock.remove();
    };

    var errorHandler = function( status, exception )
    {
        error('Impossible de supprimer ce projet', status);
    };

    AjaxSimple('DELETE', api.endPoint+'project/'+projectId+'/delete', successHandler, errorHandler);
}
