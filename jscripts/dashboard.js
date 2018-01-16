'use strict';

// main :

(function( win, doc ) {

    var projectId = dashboard.projectId;
    var userId = user.id;
    
    var isProjectAdmin = dashboard.is_admin;
    var isProjectManager = dashboard.is_manager;

    var projectsList, categoriesList;

    var popupScreen, popupContainer, isPopupOpen = false; // modal create


    window.addEventListener('load', function( event ) {

        projectsList = document.getElementById('projects-list');

        categoriesList = document.getElementById('categories-list');

        // load projects on top

        //populateProjects();

        // load categories and tasks

        populateCategoriesAndTasksList();

        // populate all the peoples linked to project ; for popup create

        populatePeoplesList();

        // initialize popover category

        initializeCategoriesEvents();

        // initialize create task popup

        initializePopupCreateButton();

        // the search engine

        initSearchEvents();
    });






    /*function populateProjects() {

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
    }*/

    function populateCategoriesAndTasksList( filter ) {
        
        categoriesList.classList.add('categories-list-loading');

        var successHandler = function( response ) {

            categoriesList.innerHTML = '';
            categoriesList.classList.remove('categories-list-loading');

            for( var index in response ) {

                var category = response[index];
                var categoryId = category.id;

                appendTemplate('category', categoriesList, category);

                populateTasksList(categoryId, filter);
            }
        };

        var errorHandler = function( status, exception ) {
            jserror('Impossible de récupérer les catégories', status);
        };

        AjaxSimple('GET', api.endPoint+'project/'+projectId+'/categories/list', successHandler, errorHandler);
    }

    function populateTasksList( categoryId, filter ) {

        var categoryList = document.querySelector('#category-'+categoryId+' .category-tasks-container');

        if( categoryList ) {

            categoryList.classList.add('category-loading');

            var successHandler = function( response ) {

                categoryList.innerHTML = '';
                categoryList.classList.remove('category-loading');

                var tasks = response.tasks;
                var isPermissionSeeAll = response.permission_see_all;

                for( var index in tasks ) {

                    var task = tasks[index];

                    // sql convert to bool :

                    task.is_deleted = ( !!+task.is_deleted );

                    task.is_completed = ( !!+task.is_completed );

                    task.avatar_url = '/avatar/' + task.assigned_to;

                    // files upload

                    var taskfiles = task.files;
                    var taskfilesurls = [];

                    // date expire

                    var days_expire = task.days_expire;
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

                    if( taskfiles ) {

                        for( var findex in taskfiles ) {
                            var fileid = taskfiles[findex];

                            taskfilesurls.push('/file/'+fileid+'/picture');
                        }
                    }

                    task.files_url = taskfilesurls;

                    // pretty dates

                    task.pretty_created_at = prettyDate(task.created_at);

                    if( task.end_at ) {
                        task.pretty_end_at = prettyDate(task.end_at);
                    }

                    // admins can seel all : so we inform the user, it's not his own task
                    task.xisPermissionSeeAll = ( isPermissionSeeAll && task.assigned_to != userId );

                    appendTemplate('task', categoryList, task);
                }
            };

            var errorHandler = function( status, exception ) {
                jserror('Impossible de récupérer les taches de la catégorie ('+categoryId+')', status);
            };

            var filterQuery = (filter ? '?filter='+filter : '');

            AjaxSimple('GET', api.endPoint+'project/'+projectId+'/category/'+categoryId+'/tasks/list'+filterQuery, successHandler, errorHandler);
        }
    }

    function initializeCategoriesEvents() {

        // category create new block

        var categoryCreateBlock = document.getElementById('category-create-block');

        delegate(categoryCreateBlock, '.button-category-create-popover, .button-category-cancel', 'click', function( event ){
            event.preventDefault();
            
            var target = event.target;

            // show popover :

            var popover = categoryCreateBlock.querySelector('#category-popover-new');

            if( popover ) {
                popover.classList.toggle('is-visible');
            }
        });

        // document.body.addEventListener('click', function( event ){ // close on outside
        //     var popover = categoryCreateBlock.querySelector('#category-popover-new');
        //     if( popover ) {
        //         popover.classList.remove('is-visible');
        //     }
        // }, true);

        delegate(categoryCreateBlock, '.button-category-create', 'click', function( event ){
            event.preventDefault();
            
            var target = event.target;


            var popover = categoryCreateBlock.querySelector('#category-popover-new');

            var form = popover.querySelector('.ha-popover-form');
            
            var data = getFormData(form);

            var successHandler = function( response ) {

                var category = response.category;
                var categoryId = category.id;

                // append category template

                categoriesList.classList.add('categories-list-loading');

                if( popover ) {
                    popover.classList.remove('is-visible');
                }
                
                appendTemplate('category', categoriesList, category);

                populateTasksList(categoryId);

                categoriesList.classList.remove('categories-list-loading');

                // notification
                jssnackbar('Catégorie ajoutée!');
            };

            var errorHandler = function( status, exception ) {
                jserror('Impossible de créer cette catégorie', status);
            };

            AjaxSimple('POST', api.endPoint+'project/'+projectId+'/category/create', successHandler, errorHandler, data);
        });


        // category edit popover

        delegate(categoriesList, '.button-category-edit-popover, .component-category-popover .button-category-cancel', 'click', function( event ){
            event.preventDefault();

            var target = event.target;

            var categoryId = target.getAttribute('data-category');

            // toggle popover :

            var popover = categoriesList.querySelector('#category-popover-'+categoryId);
            
            if( popover ) {
                popover.classList.toggle('is-visible');
            }
        });

        delegate(categoriesList, '.component-category-popover .button-category-save', 'click', function( event ){
            event.preventDefault();

            var target = event.target;

            var categoryId = target.getAttribute('data-category');
            var category = categoriesList.querySelector('#category-'+categoryId);

            // hide popover :

            var popover = categoriesList.querySelector('#category-popover-'+categoryId);

            var form = popover.querySelector('.ha-popover-form');

            var data = getFormData(form);

            var successHandler = function( response ) {
                // notification
                jssnackbar('Catégorie modifiée!');

                if( popover ) {
                    popover.classList.remove('is-visible');
                }

                var categoryTitle = category.querySelector('.category-title');

                if( categoryTitle && data.title ) {
                    categoryTitle.innerText = data.title;
                }
            };

            var errorHandler = function( status, exception ) {
                jserror('Impossible de modifier cette catégorie', status);
            };

            AjaxSimple('PATCH', api.endPoint+'category/'+categoryId+'/update', successHandler, errorHandler, data);
        });

        // delete button

        delegate(categoriesList, '.button-category-delete', 'click', function( event ){
            event.preventDefault();

            var target = event.target;

            var categoryId = target.getAttribute('data-category');


            var confirmDialog = confirm('Supprimer cette catégorie ?');

            if( confirmDialog ) {

                var successHandler = function( response ) {
                    // notification
                    jssnackbar('Catégorie supprimée!');

                    // delete elemnt

                    var categoryEl = categoriesList.querySelector('#category-'+categoryId);

                    if( categoryEl ) {
                        categoryEl.remove();
                    }
                };

                var errorHandler = function( status, exception ) {
                    jserror('Impossible de supprimer cette catégorie', status);
                };

                AjaxSimple('DELETE', api.endPoint+'category/'+categoryId+'/delete', successHandler, errorHandler);

            }
        });



        // task : delete button

        delegate(categoriesList, '.button-task-delete', 'click', function( event ){
            event.preventDefault();

            var target = event.target;

            var taskId = target.getAttribute('data-id');

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

        // task : complete

        delegate(categoriesList, '.button-task-complete', 'click', function( event ){
            event.preventDefault();

            var target = event.target;

            var taskId = target.getAttribute('data-id');

            var taskElement = document.getElementById('task-'+taskId);

            if( taskElement ) {

                var confirmDialog = confirm('Compléter cette tâche ?');

                if( confirmDialog )
                {
                    var successHandler = function( response ) {
                        
                        // notification
                        jssnackbar('Tâche complétée!');

                        taskElement.remove();
                    };
            
                    var errorHandler = function( status, exception ) {
                        jserror('Impossible de compléter cette tâche', status);
                    };
            
                    AjaxSimple('PATCH', api.endPoint+'task/'+taskId+'/complete', successHandler, errorHandler);
                
                } //confirm

            } // element exist
        });

        // task : edit button show forms elements

        delegate(categoriesList, '.button-task-edit-show', 'click', function( event ){
            event.preventDefault();

            var target = event.target;

            var taskId = target.getAttribute('data-id');

            var taskElement = document.getElementById('task-'+taskId);

            if( taskElement ) {
                
                // toggle edit mode

                toggleState(taskElement, 'edit', 'view');
            }
        });

        // task : validate update

        delegate(categoriesList, '.button-task-edit', 'click', function( event ){
            event.preventDefault();

            var target = event.target;

            var taskId = target.getAttribute('data-id');
            var categoryId = target.getAttribute('data-category');

            var taskElement = document.getElementById('task-'+taskId);

            if( taskElement ) {
                
                // todo









                // toggle edit mode

                toggleState(taskElement, 'edit', 'view');
            }
        });

    }

    function initializePopupCreateButton() {

        popupScreen = document.querySelector('.cd-popup');
        popupContainer = popupScreen.querySelector('.cd-popup-container');

        // initialize date time picker

        var datetimePicker = popupContainer.querySelector('.module-datetimepicker');
        var datetimePickerContainer = popupContainer.querySelector('.module-datetimepicker-container');

        var dateFormat = 'YYYY-MM-DD HH:mm:ss';

        DatetimePickerSimple(datetimePickerContainer, {
            //appendTo: x,
            autoClose: true,
            date: true,
            dayFormat: 'DD',
            inputFormat: dateFormat,
            time: true,
            timeFormat: 'HH:mm',
            min: new Date(),//today
            // styles: { container: 'rd-container' }
        })
        .on('ready', function( value ) { // set value on open
            var xmoment = this.getMoment();
            var value = xmoment.add(1, 'hour').format(dateFormat);

            this.setValue(value);
            datetimePicker.value = value;
        })
        .on('data', function( value ) { // set value on click
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
        
        delegate(popupScreen, '.newtask-form', 'submit', function( event ) { //.cd-button-confirm
            event.preventDefault();

            var form = event.target;
            var submit = form.querySelector('[type=submit]');

            // avoid multiple repeated uploads
            // (histeric clicks on slow connection)
           submit.disabled = true;

            // gather form datas

            var categoryId = popupContainer.getAttribute('data-category');

            var formData = getFormData(form);

            // has files .

            var filesElement = form['files'];

            formData.files = [];

            if( filesElement && filesElement.files && filesElement.files.length > 0 ) {

                var promises = [];

                forEach(filesElement.files, function( file, i ) { // todo: use 'for' to keep async promises and avoid .all

                    var promise = new Promise(function( resolve, reject ) {

                        var reader = new FileReader();
                        
                        reader.addEventListener('loadend', function( event ) {
                            var blob = btoa(this.result); //b64

                            resolve({
                                name: file.name,
                                size: file.size,
                                type: file.type,
                                lastModified: file.lastModified,
                                blob: blob 
                            });
                        });
    
                        reader.addEventListener('error', function( event ) {
                            reject(this.error);
                        });
    
                        reader.readAsBinaryString(file);
                    });

                    promise.then(function( file ) {
                        return file;
                    });

                    promises.push(promise);
                });

                var results = Promise.all(promises);

                results.then(function( files ) {
                    formData.files = files

                    callbackPost();
                });

                results.catch(function( reason ) {
                    jserror('Impossible d\'ajouter ces fichiers sur cette tâche', reason);
                });

            } else {
                // no files to add, so direct call

                callbackPost();
            }

            function callbackPost() {

                var successHandler = function( response ) {
                    
                    // close modal
                    popupScreen.classList.remove('is-visible');
                    
                    isPopupOpen = false;

                    // append task to the list ; or self if has the admin permissions

                    var xisPermissionSee = response.xisPermissionSee;

                    if( xisPermissionSee ) {
                        populateTasksList(categoryId); //todo: better add
                    }

                    // notification

                    jssnackbar('Tâche créée!');

                    jsprogressbar('new-task-progress', 'remove');

                    submit.disabled = false; // re enable create task
                };
    
                var errorHandler = function( status, exception ) {
                    jserror('Impossible de créer cette tâche', status);
                };

                var progressHandler = function( percentComplete ) {
                    if( percentComplete == 'unknown-size' ) return;
                    
                    jsprogressbar('new-task-progress', percentComplete);
                };

                AjaxSimple('POST', api.endPoint+'project/'+projectId+'/category/'+categoryId+'/task/create', successHandler, errorHandler, formData, progressHandler);
            }
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

    function initSearchEvents() {

        var filterDropdown = document.getElementById('dashboard-search-dropdown');

        var filterRadios = filterDropdown.querySelectorAll('.selectopt');

        var changeFilterHandler = function( event ) {
            var target = event.target;

            var filter = target.value;

            populateCategoriesAndTasksList(filter);
        };

        forEach(filterRadios, function( radio, index ) {
            radio.addEventListener('change', changeFilterHandler);
        });

    
    }
    







        
})(this, document);
