<?php

namespace App;

use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;

use App\Models\ProjectsModel;


class ProjectsController extends AbstractController {

    /**
     * Index function
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function __invoke( Request $request, Response $response )
    {
        if( !$this->isLogged ) return redirect('/login?back=1'); // check logged


        $projects = [];

        if( $tryProjects = ProjectsModel::getAllByUser($this->userId) )
        {
            $projects = $tryProjects;
        }

        $this->projects = $projects;


        return render('projects', $this->container);
    }


}
