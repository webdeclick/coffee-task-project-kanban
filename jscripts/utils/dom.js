'use strict';

(function( root, factory ) {

    var moduleName = 'dom';

    root[moduleName] = new (factory(root, document)); // browsers

    /*if( typeof define === 'function' && define.amd ) {
        define([], factory); // AMD
    } else if( typeof exports === 'object' ) {
        module.exports = factory(); // Node, CommonJS-like
    } else {
        win[moduleName] = factory(); // browsers
    }*/

}(this, function _factory( win, doc ) {

    function xmodule()
    {

    }

    xmodule.prototype = {
        
        querySelector: function( selector )
        {
            return doc.querySelector(selector);
        },

        querySelectorAll: function( selector )
        {
            return doc.querySelectorAll(selector);
        },



    };

    return xmodule;

}));
