<?php

// $word = '\w+';
$digit = '\d+';
// $year = '(19|20)\d\d';
// $all = '[^/]+';

return [
    'home' => ['get', '/', '\App\HomeController'],

    'login' => ['get', '/login', '\App\AuthenticationController@login'],
    'login.validate' => ['post', '/login/validate', '\App\AuthenticationController@validateLogin'],

    'register' => ['get', '/register', '\App\AuthenticationController@register'],
    'register.validate' => ['post', '/register/validate', '\App\AuthenticationController@validateRegister'],

    'logout' => ['get', '/login', '\App\AuthenticationController@logout'],

    'projects' => ['get', '/projects', '\App\ProjectsController'],
    'dashboard' => ['get', '/dashboard', '\App\DashboardController'],

    

    'api-heartbeat' => ['get', '/api/heartbeat', '\App\ApiController@heartbeat'],

    'api-project.list'   => ['get', '/api/projects/list', '\App\ApiController@projectsList'],
    'api-project.create' => ['get', '/api/project/create', '\App\ApiController@projectCreate'],
    'api-project.update' => ['get', '/api/project/(\d+)/update', '\App\ApiController@projectUpdate'],
    'api-project.delete' => ['get', '/api/project/(\d+)/delete', '\App\ApiController@proejctDelete'],

    'api-category.create' => ['get', '/api/category/create', '\App\ApiController@categoryCreate'],
    'api-category.update' => ['get', '/api/category/(\d+)/update', '\App\ApiController@categoryUpdate'],
    'api-category.delete' => ['get', '/api/category/(\d+)/delete', '\App\ApiController@categoryDelete'],

    'api-task.create' => ['get', '/api/task/create', '\App\ApiController@taskCreate'],
    'api-task.update' => ['get', '/api/task/(\d+)/update', '\App\ApiController@taskUpdate'],
    'api-task.delete' => ['get', '/api/task/(\d+)/delete', '\App\ApiController@taskDelete'],
];
