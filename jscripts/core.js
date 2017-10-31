'use strict';

// debug
function l(t){console.log(t);}

//config
var api = {
    endPoint: '/api/'
};



var DatetimePickerSimple = rome;

function compileTemplate( template, scope ) {
    return TemplateSimple(template, scope);
}

function appendTemplate( templateId, element, scope ) {

    // get <template> content
    var templateNode = document.getElementById('template-'+templateId);
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

    var e = document.createElement('div');
    e.innerHTML = html;

    var childNodes = e.childNodes, index, results = [];

    for( index in childNodes ) {
        if( childNodes.hasOwnProperty(index) ) {
            results.push(childNodes[index]);
        }
    }

    return results; //firstElementChild
}

// delegate events

function delegate( parent, target, eventType, callback ) {

    // if( isString(parent) ) {
    //     var parent = document.querySelector(parent);
    // }

    parent.addEventListener(eventType, function( event ) {

        var element = event.target;
        var matchesCallback = element.matches || element.matchesSelector;

        if( (matchesCallback).call(element, target) ) {
            callback.call(element, event);
        }
    });
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

    snackbar.innerText = text;
    
    snackbar.classList.add('is-visible');

    var timeoutId = setTimeout(function(){
        snackbar.classList.remove('is-visible');
    }, duration);
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

function swapElements( obj1, obj2 )
{
    // save the location of obj2

    var parent2 = obj2.parentNode;
    var next2 = obj2.nextSibling;

    // special case for obj1 is the next sibling of obj2

    if( next2 === obj1 )
    {
        // just put obj1 before obj2

        parent2.insertBefore(obj1, obj2);
    }
    else
    {
        // insert obj2 right before obj1

        obj1.parentNode.insertBefore(obj2, obj1);

        // now insert obj1 where obj2 was

        if( next2 )
        {
            // if there was an element after obj2, then insert obj1 right before that

            parent2.insertBefore(obj1, next2);
        }
        else
        {
            // otherwise, just append as last child

            parent2.appendChild(obj1);
        }
    }
}
