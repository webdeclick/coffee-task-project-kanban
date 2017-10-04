'use strict';


// AJAX based operations

(function( win, factory ) {
    
    var moduleName = 'AjaxSimple';
    
    win[moduleName] = factory(); // browsers
        
}(this, function _factory() {

    return function( method, url, successHandler, errorHandler, data, progressHandler )
    {
        // private methods :
    
        function parse( response )
        {
            return JSON.parse( response );
        }
    
        function stringify( data )
        {
            return JSON.stringify( data );
        }
    
        function xhrReadyStateChange()
        {
            if ( this.readyState === this.DONE ) // DONE:4
            {
                var status = this.status;
    
                if ( status >= 200 && status < 300 ) // OK
                {
                    try
                    {
                        var response = parse(this.responseText);
    
                        successHandler && successHandler(response);
                    }
                    catch( e )
                    {
                        errorHandler && errorHandler('exception', e);
    
                        /*TODO DEBUG*/console.log(e);
                    }
                }
                else
                {
                    errorHandler && errorHandler('http');
                }
            }
        }
    
        function xhrProgess( event )
        {
            if ( event.lengthComputable )
            {
                var percentComplete = Math.round(event.loaded * 100 / event.total);
    
                progressHandler && progressHandler(percentComplete);
            }
            else
            {
                progressHandler && progressHandler('unknown-size');
            }
        }
    
        function xhrTimeout( event )
        {
            errorHandler && errorHandler('timeout');
        }
    
        function xhrError( event )
        {
            errorHandler && errorHandler('error');
        }
    
        function xhrAbort( event )
        {
            errorHandler && errorHandler('abort');
        }
    
        // main :

        var x = new XMLHttpRequest();//new ActiveXObject('Microsoft.XMLHTTP');

        x.open(method, url, true);

        //x.withCredentials = true;

        x.onerror = xhrError;
        x.onabort = xhrAbort;
        x.ontimeout = xhrTimeout;

        x.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        x.onreadystatechange = xhrReadyStateChange;


        var mediaType = 'application/json';
        var mediaCharset = 'charset=utf-8';

        if( data && typeof data !== 'undefined' ) // with datas
        {
            x.setRequestHeader('Content-Type', mediaType + ';' + mediaCharset); // REST hint
    
            x.upload.onprogress = xhrProgess;
    
            x.send(stringify(data));
        }
        else // normal GET
        {
            x.setRequestHeader('Accept', mediaType); // REST hint

            x.onprogress = xhrProgess;
    
            x.send();
        }
    
    }

}));


// templating system

(function( win, factory ) {

    var moduleName = 'TemplateSimple';

    win[moduleName] = factory(); // browsers

    // if( typeof define === 'function' && define.amd ) {
    //     define([], factory); // AMD
    // } else if( typeof exports === 'object' ) {
    //     module.exports = factory(); // Node, CommonJS-like
    // } else {
    //     root.SimpleTemplate = factory(); // others
    // }
    
}(this, function _factory() {

    'use strict';

    // var cached = [];

    var symbols = {
        // default: var, no-action
        '?': { type: 'block', action: 'if' },
        '!': { type: 'block', action: 'ifnot' },
        '#': { type: 'block', action: 'loop' },
        '/': { type: 'close' },
        '&': { type: 'var', action: 'escape' },
    };

    var pipes = {
        join: function _join( value ) {
            return value.join(', ');
        },
        size: function _size( value ) {
            return ( value.length || 0 );
        },
        upper: function _upper( value ) {
            return String(value).toUpperCase();
        },
        lower: function _lower( value ) {
            return String(value).toLowerCase();
        },
        trim: function _trim( value ) {
            return String(value).trim();
        },
        date: function _date( value ) {
            return ( new Date(value).toLocaleDateString() );
        },
        nl2br: function _nl2br( value ) {
            return String(value).replace(/\n/g, '<br>');
        }
        //i18n todo
    };

    var entityMap = { // escape Html
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#39;',
        '/': '&#x2F;',
        '`': '&#x60;',
        '=': '&#x3D;'
    };

    return function( template, context ){
        return compileTemplate( template, context )
    }


    // private

    function compileTemplate( template, context )
    {
        context = context || {};

        return renderSection(template, context);
    }

    function lookup( context, path )
    {
        return path.split('.').reduce(function( prev, index ) {
            return prev ? prev[index] : undefined;
        }, context);
    }

    function getSymbol( expr )
    {
        var char = expr.charAt(0);

        var defaultSymbol = { type: 'var' };

        return ( symbols[char] ? symbols[char] : defaultSymbol );
    }

    function isSymbolType( type, symbol )
    {
        return ( symbol.type === type );
    }

    function isSymbolHasAction( symbol )
    {
        return ( symbol.action ? true : false );
    }

    // rendering a template or a child section

    function renderSection( section, context )
    {
        var template = section; // original template

        var regx = /{{\s*([a-zA-Z0-9_.-\?!\#/&:|\s]+?)\s*}}/g; // {{ aa.bb }} az09_.-?!#/&>|

        var match, expr, matches = [];
        while( match = regx.exec(section) )
        {
            expr = (match[1]).trim();
            matches.push({
                matchIndex: match.index, // pos start
                lastIndex: regx.lastIndex, // pos end
                capture: match[0], // whole {{ }}
                expr: expr, // inside {{ }}
                symbol: getSymbol(expr) // symbol: var, loop, etc
            });
        }

        var key = 0;

        while( match = matches[key++] )
        {
            var matchIndex = match.matchIndex,
                lastIndex = match.lastIndex,
                capture = match.capture,
                expr = match.expr,
                symbol = match.symbol;

            var result = null;


            if( isSymbolType('close', symbol) ) continue; // handled in block section

            if( isSymbolType('block', symbol) )
            {
                expr = expr.substring(1); // remove symbol

                var depth = 1, childMatch, childSymbol, childLastMatchIndex, childLastIndex, childSection;

                while( childMatch = matches[key++] ) // calculate the extend of a block
                {
                    childSymbol = childMatch.symbol;

                    if( isSymbolType('block', childSymbol) ) depth++;
                    else
                    if( isSymbolType('close', childSymbol) ) depth--;

                    if( depth <= 0 ) { // same depth
                        childLastMatchIndex = childMatch.matchIndex;
                        childLastIndex = childMatch.lastIndex;
                        break;
                    }
                }

                // set the child section
                capture = template.substring(matchIndex, childLastIndex); // whole
                childSection = template.substring(lastIndex, childLastMatchIndex); // inside

// console.log(capture);
// console.log(childSection);

                // render the child, based on parent's expr
                result = applySymbolCallback(symbol, expr, childSection, context);
            }
            else if( isSymbolType('var', symbol) )
            {
                if( isSymbolHasAction(symbol) )
                {
                    expr = expr.substring(1); // remove symbol
                }

                result = applySymbolCallback(symbol, expr, section, context);

                // todo null, undefined, false, 0, NaN, empty string, empty list
            }

            // replace current section, also: undefined == null
            section = section.replace(capture, result != null ? result : '');
        }

        return section; // modified
    }

    // apply the action of a specific symbol

    function applySymbolCallback( symbol, expr, section, context )
    {
        switch( symbol.type )
        {
            case 'var':
                return renderVariable(symbol, expr, section, context);
            
            case 'block':
                return renderBlock(symbol, expr, section, context);
        }
    }

    // rendering

    function renderBlock( symbol, expr, section, context )
    {
        switch( symbol.action )
        {
            case 'if': 
                return renderCondition(symbol, expr, section, context);
            
            case 'ifnot':
                return renderInvertedCondition(symbol, expr, section, context);
            
            case 'loop':
                return renderLoop(symbol, expr, section, context);
        }
    }

    function renderVariable( symbol, expr, section, context )
    {
        var parts = [];
        for( var op of expr.split('|') ) {
            if( op ) parts.push(op.trim()); // pipes, check exist & remove space
        }

        var token = parts.shift(); //  first var

        var result = lookup(context, token); // variable used

        if( isFunction(result) )
        {
            result = result.call(context);
        }

        // pipes
        if( parts.length >= 1 )
        {
            result = applyPipes(result, parts); // {{ var | pipe | pipe2... }}
        }

        // actions
        if( isSymbolHasAction(symbol) )
        {
            switch( symbol.action )
            {
                case 'escape':
                    result = escapeHtml(result);
                break;
            }
        }

        return result;
    }

    function addPipe( key, callback )
    {
        pipes[key] = callback;
    }

    function applyPipes( value, pipes )
    {
        var pipe, fn, result = value;

        for( pipe of pipes )
        {
            fn = pipes[pipe];

            if( fn && isFunction(fn) )
            {
                try {
                    result = fn.call(null, result); // TODO if undefined | null
                }
                catch( e ) {}
            }
        }

        return result;
    }

    function renderCondition( symbol, expr, section, context )
    {
        var environment = lookup(context, expr); // variable used

        if( environment )
        {
            return renderSection(section, context);
        }
    }

    function renderInvertedCondition( symbol, expr, section, context )
    {
        var environment = lookup(context, expr); // variable used

        if( !environment )
        {
            return renderSection(section, context);
        }
    }

    function renderLoop( symbol, expr, section, context )
    {
        var parts = [];
        for( var op of expr.split(':', 3) ) {
            if( op ) parts.push(op.trim()); // key as value, check exist & remove space
        }

        var token = parts.shift(); // first var

        var isAsValue = ( parts.length == 1 ); // #token > value
        var isAsKeyValue = ( parts.length == 2 ); // #token > key > value

        if( isAsValue ) {
            var valueName = parts[0];
        }
        else if( isAsKeyValue ) {
            var keyName = parts[0];
            var valueName = parts[1];
        }

        var environment = lookup(context, token); // variable used

        if( environment ) // also [] && {}
        {
            var key, result = '';

            for( key in environment )
            {
                if( !environment.hasOwnProperty(key) ) continue; // skip proto

                if( isAsValue || isAsKeyValue )
                {
                    if( isAsKeyValue ) {
                        context[keyName] = key; //todo best to use a subContext than propagate thru the context?
                    }

                    context[valueName] = environment[key];
                }

                result += renderSection(section, context);
            }

            return result;
        }
    }

    // helpers

    function isFunction( object )
    {
        return ( typeof object === 'function' );
    }

    function escapeHtml( text )
    {
        return String(text).replace(/[&<>"'`=\/]/g, function( s ) {
            return entityMap[s];
        });
    }

}));


// date prettier

(function( win, factory ) {
    
    var moduleName = 'prettyDate';
    
    win[moduleName] = factory(); // browsers

}(this, function _factory() {

    return function ( date )
    {
        var pretty = {

            default: '---',

            prefixAgo: 'il y a',
            prefixFromNow: 'd\'ici',
            prefixDate: 'le',

            translateDateWhen: 60*60*24*31*5, // convert to date when > 5 months in seconds

            wordSeparator: ' ',

            seconds: 'moins d\'une minute',

            minute: 'environ une minute',
            minutes: 'environ %d minutes',

            hour: 'environ une heure',
            hours: 'environ %d heures',

            day: 'environ un jour',
            days: 'environ %d jours',

            week: 'environ une semaine',
            weeks: 'environ %d semaines',

            month: 'environ un mois',
            months: 'environ %d mois',

            year: 'un an',
            years: '%d ans',

            dateMonths: ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre']
        };


        function isValid( date )
        {
            return ( !isNaN(date.getTime()) );
        }

        function substitute( string, number ) 
        {
            number = Math.floor(number); //

            return string.replace('%d', number);
        }

        function translateDate( date )
        {
            var day = date.getDate().toString();

            day = ( day.length > 1 ? day : '0' + day );

            var month = pretty.dateMonths[date.getMonth()];

            var year = date.getFullYear();


            return ([pretty.prefixDate, day, month, year].join(pretty.wordSeparator));
        }

        function translateWords( distance, isFuture )
        {
            var seconds = distance / 1000;
            var minutes = seconds / 60;
            var hours = minutes / 60;
            var days = hours / 24;
            var weeks = days / 7;
            var months = days / 31;
            var years = days / 365;

            var words = (

                seconds < 60 && substitute(pretty.seconds, seconds) || // almost now

                minutes < 2  && substitute(pretty.minute, 1)        ||
                minutes < 60 && substitute(pretty.minutes, minutes) ||

                hours < 2  && substitute(pretty.hour, 1)      ||
                hours < 24 && substitute(pretty.hours, hours) ||

                days < 2 && substitute(pretty.day, 1)     ||
                days < 7 && substitute(pretty.days, days) ||

                weeks  < 2 && substitute(pretty.week, 1)      ||
                months < 1 && substitute(pretty.weeks, weeks) ||

                months < 2  && substitute(pretty.month, 1)       ||
                months < 12 && substitute(pretty.months, months) ||

                years < 2 && substitute(pretty.year, 1) || substitute(pretty.years, years)
            );

            if( !words ) return pretty.default;


            return ( [(isFuture ? pretty.prefixFromNow : pretty.prefixAgo), words].join(pretty.wordSeparator) );
        }

        // parsing :

        var date = (date instanceof Date) ? date : new Date(date);

        if( !isValid(date) ) return pretty.default; // not a valid date


        var diff = ( (new Date()).getTime() - date.getTime() );

        var isFuture = ( diff < 0 ); // in the future

        var distance = Math.abs(diff); // millis


        // translate distance to words or date

        if( !pretty.translateDateWhen || distance < pretty.translateDateWhen*1000 )
        {
            return translateWords(distance, isFuture);
        }
        else
        {
            return translateDate(date);
        }
    }

}));
