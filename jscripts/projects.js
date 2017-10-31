'use strict';

(function( win, doc ) { 

    var categoryList, categoryFormNew;


    window.addEventListener('load', function( event ) {
    
        // projects list

        categoryList = document.getElementById('projects-list');

        delegate(categoryList, '.component-project .project-delete', 'click', deleteProjectEvent);

        // new form

        categoryFormNew = document.getElementById('project-new-form');

        categoryFormNew.addEventListener('submit', addProjectEvent);


        // load projects list

        populateProjectsList();
    });






    function populateProjectsList() {

        categoryList.classList.add('projects-list-loading');

        var successHandler = function( response ) {

            categoryList.innerHTML = '';
            categoryList.classList.remove('projects-list-loading');

            for( var index in response ) {

                var project = response[index];

                appendTemplate('project', categoryList, project);
            }
        };

        var errorHandler = function( status, exception ) {
            jserror('Impossible de récupérer les projets', status);
        };

        AjaxSimple('GET', api.endPoint+'projects/list', successHandler, errorHandler);
    }



    function addProjectEvent( event ) {

        var target = event.target;
    
        event.preventDefault(); // form

        var form = this;

        var fields = ['title','description','users','manager'];
        var formData = {};
    
        for( var i in fields ) {

            var field = fields[i];

            formData[field] = form[field].value; //.elements
        }

        // call ajax create
    
        var successHandler = function( response ) {
            // repopulate projets list

            populateProjectsList();
        };
    
        var errorHandler = function( status, exception ) {
            jserror('Impossible de créer ce projet', status);
        };

        AjaxSimple('POST', api.endPoint+'project/create', successHandler, errorHandler, formData);
    }

    function updateProjectEvent( event ) {
    
    }

    function deleteProjectEvent( event ) {

        var target = event.target;
    
        event.preventDefault(); // button

        // find project block

        var projectBlock = findAncestor(target, '.component-project');
    
        var projectId = projectBlock.getAttribute('data-id');
    
        // call ajax delete

        categoryList.classList.add('projects-list-loading');
    
        var successHandler = function( response ) {

            categoryList.classList.remove('projects-list-loading');

            projectBlock.remove();
        };
    
        var errorHandler = function( status, exception ) {
            jserror('Impossible de supprimer ce projet', status);
        };
    
        AjaxSimple('DELETE', api.endPoint+'project/'+projectId+'/delete', successHandler, errorHandler);
    }

})(this, document);

