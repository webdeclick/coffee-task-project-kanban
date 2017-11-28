<?php

namespace App;

use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;


class HomeController extends AbstractController {


    /**
     * Index function
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function __invoke( Request $request, Response $response )
    {
        //$this->title = 'Accueil';

        return render('index', $this->container);
    }





}
