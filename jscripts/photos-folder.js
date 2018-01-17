'use strict';

(function( win, doc ) { 

    var projectId = dashboard.projectId;
    var categoryList;


    window.addEventListener('load', function( event ) {
    
        // projects list

        categoryList = document.getElementById('photos-list');

        // add photos folder

        populateProjectsList();

        // events

        initializeFoldersEvents();
    });


    function initializeFoldersEvents() {

        // delete / validate photos

        delegate(categoryList, '.component-photo .photo-action', 'click', function( event ) {
            event.preventDefault();

            var target = event.target;

            var state = getState(target); // delete / validate

            var photoId = target.getAttribute('data-id');

            var photoBlock = findAncestor(target, '.component-photo');
            var folderBlock = findAncestor(target, '.component-folder');

            if( folderBlock ) { // folder parent (task)
                folderBlock.classList.add('component-folder-loading');
            }
            

            var successHandler = function( response ) {

                folderBlock.classList.remove('component-folder-loading');

                photoBlock.remove(); // disable photo ; already validate or deleted

                var remainingPhotos = folderBlock.querySelectorAll('.component-photo').length;

                if( remainingPhotos <= 0 ) {
                    // all photos are removed, so we hide the folder too
                    folderBlock.remove();
                }

                if( state == 'validate' ){
                    // notification
                    jssnackbar('Photo validée!');
                }
                if( state == 'delete' ){
                    // notification
                    jssnackbar('Photo supprimée!');
                }
            };

            var errorHandler = function( status, exception ) {
                jserror('Impossible d\'effectuer cette action sur la photo', status);
            };

            AjaxSimple('POST', api.endPoint+'file/'+photoId+'/'+state, successHandler, errorHandler);
        });
    }


    function populateProjectsList() {

        categoryList.classList.add('photos-list-loading');

        var successHandler = function( response ) {

            categoryList.innerHTML = '';
            categoryList.classList.remove('photos-list-loading');

            for( var index in response ) {

                var task = response[index];
                var files = task.files || [];

                for( var fileindex in files ) {
                    var file = files[fileindex];

                    files[fileindex].photo_url = '/file/'+file.id+'/picture';
                }

                task.files = files;

                appendTemplate('photos-folder', categoryList, task);
            }
        };

        var errorHandler = function( status, exception ) {
            jserror('Impossible de récupérer les photos', status);
        };

        AjaxSimple('GET', api.endPoint+'project/'+projectId+'/photos-folder', successHandler, errorHandler);
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
