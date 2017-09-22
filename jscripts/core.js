'use strict';


var components = {
    'projects': '',
    'dashboard.categories': '',
    'dashboard.categories.tasks': '',
    'user.profile': '',

};







function appendTemplate( templateId, element, scope, events )
{
    // get <template> content
    var templateNode = document.getElementById('template-'+templateId);
    var template = templateNode.content;

    // add events to scope
    var scope = scope || {};
    scope.events = events || {};

    // create doc fragment and append tpl to it
    var fragment = document.createDocumentFragment();

    var compiled = compileTemplate(template, scope);
    fragment.appendChild(htmlToNode(compiled));

    element.appendChild(fragment);
}

function compileTemplate( template, scope )
{
    return xtemplate(template, scope);
}

function htmlToNode( html )
{
    var e = document.createElement('div');
    e.innerHTML = html;

    return e.firstElementChild;
}

