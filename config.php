<?php

// dev 
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);
ini_set('html_errors', 0);

// setlocale(LC_ALL, 'fr_FR.UTF-8');
// date_default_timezone_set('Europe/Paris');

// <!------------------------------------------------------------!> //

return [

    // Database access

    'database' => [
        'driver'    => 'mysql',
        'host'      => '127.0.0.1',
        'database'  => 'kanban',
        'username'  => 'root',
        'password'  => 'helloworld',
        'prefix'    => '',
        'charset'  => 'utf8', // utf8mb4
        'options' => [
            PDO::ATTR_CASE => PDO::CASE_NATURAL,
            PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
            PDO::ATTR_STRINGIFY_FETCHES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // FETCH_OBJ / FETCH_ASSOC
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => true, // override reuse named
        ]
    ]

];

