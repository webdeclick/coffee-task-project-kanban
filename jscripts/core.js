'use strict';


var components = {
    'projects': '',
    'dashboard.categories': '',
    'dashboard.categories.tasks': '',
    'user.profile': '',

};







function appendTemplate( templateId, element, scope, events )
{
    var templateNode = document.getElementById('template-'+templateId);
    var template = templateNode.content;

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

