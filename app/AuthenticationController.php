<?php

namespace App;

use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;

use App\Models\UserModel;



class AuthenticationController extends AbstractController {


    /**
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function login( Request $request, Response $response )
    {
        if( $this->isLogged ) return redirect('/projects'); // logged-in

        return render('login');
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function register( Request $request, Response $response )
    {
        if( $this->isLogged ) return redirect('/projects'); // logged-in

        return render('register');
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function validateLogin( Request $request, Response $response )
    {
        if( $this->isLogged ) return redirect('/projects'); // logged-in

    
        $email = $request->input('email');

        $password = $request->input('password');

        
        // return redirect('/projects');



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
        if( $this->isLogged ) return redirect('/projects'); // logged-in


        $email = $request->input('email');
        
        $password  = $request->input('password');
        $password2 = $request->input('password2');

    
        if( !empty($email) && $tryUserId = UserModel::getIdByEmail($email) )
        {
            $this->errors[] = __('register.emailnotavailable')
        }
        else
        {
            $this->errors[] = 'Veuillez renseigner un pseudo';
        }



        return render('register');
    }


    public function logout()
    {
        session_destroy();

        return redirect('/'); //home
    }


}
