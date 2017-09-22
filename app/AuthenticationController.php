<?php

namespace App;

use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;


class AuthenticationController extends AbstractController {

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function validateLogin( Request $request, Response $response )
    {

        





        return render('login');
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function validateRegister( Request $request, Response $response )
    {










        return render('register');
    }


}
