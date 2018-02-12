<?php

// $word = '\w+';
// $digit = '\d+';
// $year = '(19|20)\d\d';
// $all = '[^/]+';

return [
    'home' => ['get', '/', '\App\PageController@home'],

    'login' => ['get', '/login', '\App\AuthenticationController@login'],
    'login.validate' => ['post', '/login/validate', '\App\AuthenticationController@validateLogin'],

    'register' => ['get', '/register', '\App\AuthenticationController@register'],
    'register.validate' => ['post', '/register/validate', '\App\AuthenticationController@validateRegister'],

    'avatar' => ['get', '/avatar/(\d+)', '\App\AuthenticationController@avatar'],
    'profile' => ['get', '/profile', '\App\AuthenticationController@profile'],
    'profile.validate' => ['post', '/profile/update', '\App\AuthenticationController@validateProfile'],

    'logout' => ['get', '/logout', '\App\AuthenticationController@logout'],

    'projects' => ['get', '/projects', '\App\ProjectsController'],
    'dashboard' => ['get', '/dashboard/(\d+)', '\App\DashboardController'],

    'photos-folder' => ['get', '/photos-folder/(\d+)', '\App\ProjectsController@photosFolder'],
	
	

    // pages

    'contact' => ['get', '/contact', '\App\PageController@contact'],
	'contact.post' => ['post', '/contact/post', '\App\PageController@post_contact'],
    'mentions' => ['get', '/mentions', '\App\PageController@mentions'],
    'sitemap' => ['get', '/sitemap', '\App\PageController@sitemap'],

    // projects api

    'api-projects.list' => ['get', '/api/projects/list', '\App\ApiController@projectsList'],
    'api-project.peoples.list' => ['get', '/api/project/(\d+)/peoples/list', '\App\ApiController@projectPeoples'],

    // project api management

    'api-project.create' => ['post',   '/api/project/create', '\App\ApiController@projectCreate'],
    'api-project.update' => ['patch',  '/api/project/(\d+)/update', '\App\ApiController@projectUpdate'],
    'api-project.delete' => ['delete', '/api/project/(\d+)/delete', '\App\ApiController@projectDelete'],

    'api-photos-folder' => ['get', '/api/project/(\d+)/photos-folder', '\App\ApiController@photosFolder'],
    'api-photos-folder.action' => ['post', '/api/file/(\d+)/(\w+)', '\App\ApiController@photosFolderAction'],

    // categories api

    'api-category.list' => ['get', '/api/project/(\d+)/categories/list', '\App\ApiController@categoriesList'],
    'api-category.tasks.list' => ['get', '/api/project/(\d+)/category/(\d+)/tasks/list', '\App\ApiController@categoriesTasksList'],

    // categories management api

    'api-category.create' => ['post',   '/api/project/(\d+)/category/create', '\App\ApiController@categoryCreate'],
    'api-category.update' => ['patch',  '/api/category/(\d+)/update', '\App\ApiController@categoryUpdate'],
    'api-category.delete' => ['delete', '/api/category/(\d+)/delete', '\App\ApiController@categoryDelete'],

    // tasks management api

    'api-task.get' => ['get',   '/api/task/(\d+)', '\App\ApiController@taskGet'],
    'api-task.create' => ['post',   '/api/project/(\d+)/category/(\d+)/task/create', '\App\ApiController@taskCreate'],
    'api-task.update' => ['patch',  '/api/task/(\d+)/update', '\App\ApiController@taskUpdate'],
    'api-task.delete' => ['delete', '/api/task/(\d+)/delete', '\App\ApiController@taskDelete'],
    'api-task.complete' => ['patch', '/api/task/(\d+)/complete', '\App\ApiController@taskComplete'],

    // tasks files

    'api-task.file-picture' => ['get', '/file/(\d+)/picture', '\App\DashboardController@filePicture'],

];
