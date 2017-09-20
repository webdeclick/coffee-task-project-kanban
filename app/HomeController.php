<?php

namespace App;

use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;


class HomeController {

    public function __invoke( Request $request, Response $response )
    {
        return render('index');
    }





}
