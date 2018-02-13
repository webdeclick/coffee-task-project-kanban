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

                // get all folders :
                var folders = document.querySelectorAll('.component-folder');
                var folderCount = folders.length;
                if( folderCount == 0 ) {
                    // if empty ; add placeholder
                    appendTemplate('photos-folder-empty', categoryList);
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

            var folderCount = 0;

            for( var index in response ) {

                var task = response[index];
                var files = task.files || [];

                // date expire

                var days_expire = task.task_days_expire;
                var expire_class = null;

                if( task.is_completed ) {
                    expire_class = 'completed';
                }
                else if( days_expire <= 0 ) {
                    expire_class = 'expired';
                }
                else if( days_expire <= 2 ) {
                    expire_class = '2days';
                }
                else if( days_expire <= 5 ) {
                    expire_class = '5days';
                }
                else if( days_expire <= 10 ) {
                    expire_class = '10days';
                }
                else if( days_expire <= 15 ) {
                    expire_class = '15days';
                }

                if( expire_class ) {
                    expire_class = 'expire-' + expire_class;
                }

                task.expire_class = expire_class;

                // loop files

                for( var fileindex in files ) {
                    var file = files[fileindex];

                    files[fileindex].photo_url = '/file/'+file.id+'/picture';
                }

                task.files = files;

                appendTemplate('photos-folder', categoryList, task);

                folderCount++;
            }

            if( folderCount == 0 ) {
                // add placeholder
                appendTemplate('photos-folder-empty', categoryList);
            }

        };

        var errorHandler = function( status, exception ) {
            jserror('Impossible de récupérer les photos', status);
        };

        AjaxSimple('GET', api.endPoint+'project/'+projectId+'/photos-folder', successHandler, errorHandler);
    }


})(this, document);
