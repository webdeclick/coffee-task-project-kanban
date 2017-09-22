<?php

namespace App;

use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;


class DashboardController extends AbstractController {

    /**
     * Index function
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function __invoke( Request $request, Response $response )
    {
        // check logged


        return render('dashboard');
    }





}
