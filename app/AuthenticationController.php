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
        if( $this->isLogged ) return redirect('/projects'); // check logged

        return render('login', $this->container);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function register( Request $request, Response $response )
    {
        if( $this->isLogged ) return redirect('/projects'); // check logged

        return render('register', $this->container);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function validateLogin( Request $request, Response $response )
    {
        if( $this->isLogged ) return redirect('/projects'); // check logged


        $email = $request->input('email');
        $password = $request->input('password');

        // create session user
        if( $email && $password )
        {
            $passHash = passhash($password);

            if( $userId = UserModel::getIdByLogin($email, $passHash) )
            {
                // try login
                session('isLogged', true);
                session('userId', $userId);
                
                return redirect('/projects');
            }
            else
            {
                $this->errors = 'Pseudo ou pass incorrect';
            }
        }
        else
        {
            $this->errors = 'Veuillez renseigner des informations';
        }


        return render('login', $this->container);
    }

    /**
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function validateRegister( Request $request, Response $response )
    {
        if( $this->isLogged ) return redirect('/projects'); // check logged


        $fullname = $request->input('fullname');
        $email = $request->input('email');

        $password1 = $request->input('password1');
        $password2 = $request->input('password2');


        if( empty($fullname) )
        {
            $this->errors = 'Vous devez renseignervotre nom';
        }

        if( !empty($email) )
        {
            if( $tryUserId = UserModel::getIdByEmail($email) )
            {
                $this->errors = 'Cet email est déjà utilisé';
            }
        }
        else
        {
            $this->errors = 'Vous devez renseigner votre email';
        }

        if( !empty($password1) && !empty($password2) )
        {
            if( $password1 != $password2 )
            {
                $this->errors = 'Vos mots de passe ne correspondent pas';
            }
        }
        else
        {
            $this->errors = 'Vous devez renseigner un mot de pass';
        }

        // no errors : validate

        if( !isset($this->errors) )
        {
            $passHash = passhash($password1);

            $userData = [
                'fullname' => $fullname,
                'email' => $email,
                'password' => $passHash
            ];

            $newUser = new UserModel($userData);

            $userId = $newUser->create();

            // try login
            session('isLogged', true);
            session('userId', $userId);
            
            return redirect('/projects');
        }


        return render('register', $this->container);
    }


    public function logout()
    {
        session_destroy();

        return redirect('/'); //home
    }


}
