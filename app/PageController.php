<?php

namespace App;

use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;

use Slim\Routing\Exceptions\NotFoundException;
use Slim\Routing\Exceptions\MethodNotAllowedException;


/**
 * Page Controller
 * Simple page rendering
 */
class PageController extends AbstractController {


    /**
     * Page rendering function
     *
     * @param Request $request
     * @param Response $response
     * @throws NotFoundException
     * @return void
     */
    public function __invoke( Request $request, Response $response )
    {
        throw new NotFoundException;
    }

    /**
     * Home page
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function home( Request $request, Response $response )
    {
        $this->title = 'Accueil';

        return render('index', $this->container);
    }

    /**
     * Contact page
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
	
	public function post_contact( Request $request, Response $response ){
		
		 $mail = xmail([
                    'subject' => 'Nous avons bien reçu votre message !',
                    'address' => $_POST["mail"],
                    'body' => $_POST["message"]
                ]);
		$this->message = 'Mercizfkqzref';
		return render('contact', $this->container);
		
	}
	
    public function contact( Request $request, Response $response ){
        $this->title = 'Contact';
		

				return render('contact', $this->container);
    }

    /**
     * Mentions page
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function mentions( Request $request, Response $response )
    {
        $this->title = 'Mentions légales';

        return render('mentions', $this->container);
    }

    /**
     * Sitemap page
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function sitemap( Request $request, Response $response )
    {
        $this->title = 'Plan du site';

        return render('sitemap', $this->container);
    }


}
