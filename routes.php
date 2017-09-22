<?php

// $word = '\w+';
// $digit = '\d+';
// $year = '(19|20)\d\d';
// $all = '[^/]+';

return [
    'home' => ['get', '/', '\App\HomeController'],

    'login' => ['get', '/login', '\App\AuthenticationController@login'],
    'register' => ['get', '/register', '\App\AuthenticationController@register'],
    'login.validate' => ['post', '/login/validate', '\App\AuthenticationController@validateLogin'],
    'register.validate' => ['post', '/register/validate', '\App\AuthenticationController@validateRegister'],
    'logout' => ['get', '/login', '\App\AuthenticationController@logout'],

    'projects' => ['get', '/projects', '\App\ProjectsController'],

    'dashboard' => ['get', '/dashboard', '\App\DashboardController'],



];
