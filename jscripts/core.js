'use strict';

// debug
function l(t){console.log(t);}

//config
var api = {
    endPoint: '/api/'
};


var rome = rome || null;
var DatetimePickerSimple = rome;

function compileTemplate( template, scope ) {
    return SimpleTemplate(template, scope);
}

function prettyDate( date ) {
    return SimplePrettyDate(date);
}

initializeTaskModalEvents();


function AjaxAPISimple( method, url, successHandler, errorHandler, data, progressHandler ) {

    var successHandlerCustom = function( response ) {
        if( response.error ) {
            var code = response.error.code;

            if( code == 'CannotAction' ) {
                return errorHandler(code);
            }
        }

        return successHandler(response);
    };

    AjaxSimple(method, url, successHandlerCustom, errorHandler, data, progressHandler);
}


function initializeTaskModalEvents() {

    var popupScreen, popupTaskContainer;

    function locationHashChangeEvent( event ) {
        var hash = location.hash;

        if( hash.startsWith('#task-') ) {
            var taskId = hash.replace('#task-', '');

            if( taskId ) {
                modalTaskOpenEvent(event, taskId);
            }
        }
    }

    function modalTaskOpenEvent( event, taskId ) {
        event.preventDefault();

        //hide previous popup
        popupScreen.classList.remove('is-visible');

        if( !taskId ) {
            var target = event.target;

            var taskId = target.getAttribute('data-modal-task');
        }

        if( !taskId ) {
            return;
        }

        var errorHandler = function( status, exception ) {
            jssnackbar('Impossible de voir cette tâche');
        };

        var successHandler = function( response ) {

            if( response.error ) {
                return errorHandler('TaskNotExist');
            }

            var task = response;

            // pretty dates
                                
            task.pretty_created_at = prettyDate(task.created_at);
                                
            if( task.end_at ) {
                task.pretty_end_at = prettyDate(task.end_at);
            }

            // files upload
                                
            var taskfiles = task.files;
            var taskfilesurls = [];

            if( taskfiles ) {

                for( var findex in taskfiles ) {
                    var fileid = taskfiles[findex];
                    
                    taskfilesurls.push('/file/'+fileid+'/picture');
                }
            }

            task.files_url = taskfilesurls;

            // render html

            popupTaskContainer.innerHTML = '';
            
            appendTemplate('task', popupTaskContainer, task);

            // open modal
            popupScreen.classList.add('is-visible');
        };
        
        AjaxAPISimple('GET', api.endPoint+'task/'+taskId, successHandler, errorHandler);
    }

    function modalTaskCloseEvent( event ) {
        event.preventDefault();
                
        popupScreen.classList.remove('is-visible');
    }

    window.addEventListener('load', function( event ) {

        popupScreen = document.getElementById('modal-popup-task');
        popupTaskContainer = popupScreen.querySelector('.modal-task-container');

        // open modal ; via create buttons on categories list

        //delegate(document, '[data-modal-task]', 'click', modalTaskOpenEvent);

        // hash change url

        window.addEventListener('hashchange', locationHashChangeEvent);

        locationHashChangeEvent(event);

        // close modal ; nope button

        delegate(popupScreen, '.cd-popup, .cd-popup-close, .cd-button-quit', 'click', modalTaskCloseEvent);
    });
}


function appendTemplate( templateId, element, scope ) {

    // get <template> content
    var templateNode = document.getElementById('template-'+templateId);

    if( !templateNode ) {
        return;
    }

    var template = templateNode.innerHTML;//content

    // create doc fragment and append compiled to it
    var fragment = document.createDocumentFragment();

    var compiled = compileTemplate(template, scope);
    
    var nodes = htmlToNodes(compiled);

    for( var index in nodes ) {
        var node = nodes[index];

        fragment.appendChild(node);
    }

    element.appendChild(fragment);
}

function htmlToNodes( html ) {

    var results = [];

    var e = document.createElement('div');
    e.innerHTML = html;

    var index, childNodes = e.childNodes;

    for( index in childNodes ) {
        if( childNodes.hasOwnProperty(index) ) {
            results.push(childNodes[index]);
        }
    }

    return results; //firstElementChild
}

// delegate events

function delegate( parent, target, eventType, callback ) {

    parent.addEventListener(eventType, function( event ) {
        var element = event.target;
        var matchesCallback = element.matches || element.matchesSelector;

        if( (matchesCallback).call(element, target) ) {
            callback.call(element, event);
        }
    });
}

// debouncing event

function delayedListener( element, eventName, callback, delay ) {
    var timeout;
    delay = delay || 300;
    element.addEventListener(eventName, function( event ) {
        window.clearTimeout(timeout);
        timeout = setTimeout(callback, delay);
    });
}

function getFormData( form ) {

    var formData = new FormData(form);
    var jsonObject = {};

    formData.forEach(function( value, key ) {

        if(jsonObject[key]) return; // only 1st ; eg:multiple files

        var element = form[key];

        jsonObject[key] = value;
    });

    return jsonObject;
}

function toggleState( element, one, two ) {
    element.setAttribute('data-state', element.getAttribute('data-state') === one ? two : one);
}

function getState( element ) {
    return element.getAttribute('data-state');
}

function forEach( array, callback, scope ) {
    for( var i = 0, length = array.length; i < length; i++ ) {
        callback.call(scope, array[i], i); // passes back stuff we need
    }
}

// display an error message ( modal, page )

function jserror( text, status ) {

    function stackTrace() {
        return ( new Error().stack || '' );
    }

    var div = document.getElementById('api-error');

    var emessage = div.querySelector('.message');

    var estatus = div.querySelector('.status');

    var estack = div.querySelector('.stack');

    emessage.innerText = 'Erreur: "' + text + '", essayez de recharger la page.';

    if( status ) {
        estatus.innerText = 'Code: ' + status;
    }

    // show / hide stack, quick-dirty function ; for users

    estatus.onclick = function( event ) {
        estack.classList.toggle('is-visible');
    };

    estack.innerText = stackTrace();

    // show the message

    div.classList.add('is-visible');
}


// display a snackbar at the bottom of the screen

function jssnackbar( text, duration ) {

    var duration = duration || 2500;

    var snackbar = document.getElementById('snackbar');

    if( snackbar ) {

        snackbar.innerText = text;
    
        snackbar.classList.add('is-visible');
    
        var timeoutId = setTimeout(function(){
            snackbar.classList.remove('is-visible');
        }, duration);
    }
}

// progress bar

function jsprogressbar( elmentid, percentComplete ) {

    var progressbar = document.getElementById(elmentid);

    if( percentComplete == 'remove' ) {
        progressbar.classList.remove('is-visible');
    }
    else {
        progressbar.classList.add('is-visible');

        var percentage = progressbar.querySelector('.percentage');

        percentage.style.width = percentComplete + '%';
        percentage.innerText = percentComplete * 1 + '%';
    }
}








// placeholder, when there is not items to display

function addPlaceholder( container, text ) {

    var placeholder = document.createElement('div');

    placeholder.classList.add('placeholder');

    // smiley top

    var smiley = document.createElement('div');

    smiley.classList.add('smiley');

    smiley.innerText = '☺';

    placeholder.appendChild(smiley);

    // description, bottom

    var description = document.createElement('div');

    description.classList.add('description');

    description.innerHTML = text;

    placeholder.appendChild(description);

    // add to the element :

    container.appendChild(placeholder);
}

function removePlaceholder( container ) {

    var placeholder = container.querySelector('.placeholder');

    if( placeholder ) {
        placeholder.remove();
    }
}


///////////////////////////////////////////////////////////////////////


// utils :

function isArray( item ) {
    return Array.isArray(item);
}

function isObject( item ) { // array is also an object
    return ( item && typeof item === 'object' );
}

function isString( item ) {
    return ( item && typeof item === 'string' );
}

function empty( value ) {
    return ( isArray(value) && value.length < 1 ) || ( [undefined, null, false, 0, '', '0'].indexOf(value) > -1 );
}

function isset( value ) {
    return ( [undefined, null].indexOf(value) < 0 );
}

// recursive deep copy of an object, no references used

function fusion( first ) {

    var hasOwnProperty = Object.hasOwnProperty;

    // check if the first is an array, then mix the rest

    var extended = ( isArray(first) ? [] : {} );

    function merge( target, args )
    {
        for( var i = 0, l = args.length; i < l; i++ ) //0=target
        {
            var source = args[i];

            for( var key in source )
            {
                if( isObject(source[key]) ) // array is also an object
                {
                    target[key] = ( isArray(source[key]) ? [] : {} );

                    merge(target[key], [ source[key] ]);
                }
                else if( hasOwnProperty.call(source, key) )
                {
                    target[key] = source[key];
                }
            }
        }

        return target;
    }

    // merging

    //var slice = [].slice;
    //return merge(extended, slice.call(arguments, 1));

    return merge(extended, arguments);
}

function clone( target ) {
    return fusion({}, target);
}

// find the ancestor of an element || null

function findAncestor( el, selector ) // element.closest polyfill
{
    while(  (el = el.parentElement) && !( (el.matches || el.matchesSelector).call(el, selector) )  );

    return el;
}

// pollyfill

if (!String.prototype.startsWith) {
    String.prototype.startsWith = function(searchString, position){
      return this.substr(position || 0, searchString.length) === searchString;
  };
}


// function String.prototype.format = function()
// {
//     var args = arguments;

//     return this.replace(/{(\d+)}/g, function( match, number )
//     {
//         return ( typeof args[number] != 'undefined' ? args[number] : match );
//     });
// }

// function strip( number ) // binary float : 10 - 9.1 == 0.9000000000000004
// {
//     return +(parseFloat(number).toPrecision(12));

//     // + toFixed()
// }

// swap elements https://stackoverflow.com/a/10717422

/*
function swapElements( obj1, obj2 ) {
    // save the location of obj2

    var parent2 = obj2.parentNode;
    var next2 = obj2.nextSibling;

    // special case for obj1 is the next sibling of obj2

    if( next2 === obj1 ) {

        // just put obj1 before obj2
        parent2.insertBefore(obj1, obj2);

    } else {
        // insert obj2 right before obj1
        obj1.parentNode.insertBefore(obj2, obj1);

        // now insert obj1 where obj2 was
        if( next2 ) {

            // if there was an element after obj2, then insert obj1 right before that
            parent2.insertBefore(obj1, next2);
        } else {

            // otherwise, just append as last child
            parent2.appendChild(obj1);
        }
    }
}
*/

/*
function promiseChain(chain) {

    var promise = Promise.resolve();

    chain.forEach(function(v, i) {
        var p = new Promise(v);
        promise = promise.then(p);
    });

    return promise;

    // var output = new Promise(chain[0]);
    // for( var i = 1, length = chain.length; i < length; i++ ) { // skip 1st
    //     var f = chain[i];
    //     var promise = new Promise(f);
    //     output = output.then(promise);
    // }
    // return output;

    // var promises = [];

    // for( var i = 0, length = chain.length; i < length; i++ ) { // skip 1st
    //     var f = chain[i];
    //     promises.push(new Promise(f));
    // }
    // return Promise.all(promises);
}
*/
