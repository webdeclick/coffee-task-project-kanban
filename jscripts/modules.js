'use strict';




(function( win, factory ) {

    var moduleName = 'xdom';

    win[moduleName] = new (factory(win, document)); // browsers

}(this, function _factory( win, doc ) {

    function xmodule()
    {

    }

    xmodule.prototype = {
        
        getElementById: function( selector )
        {
            return doc.getElementById(selector);
        },

        querySelector: function( selector )
        {
            return doc.querySelector(selector);
        },

        querySelectorAll: function( selector )
        {
            return doc.querySelectorAll(selector);
        },

        createFragment: function()
        {
            return doc.createDocumentFragment();
        },

    };

    return xmodule;

}));




(function( win, factory ) {

    var moduleName = 'xtemplate';

    win[moduleName] = (factory()); // browsers

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

    function xmodule(template, context){
        return compileTemplate( template, context )
    }

    return xmodule;


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

        var regx = /{{\s*([a-zA-Z0-9\_.\-?!#\/&>\|\s]+?)\s*}}/g; // {{ aa.bb }} az09_.-?!#/&>|

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
        for( var op of expr.split('>', 3) ) {
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



