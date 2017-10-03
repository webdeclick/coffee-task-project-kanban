<?php

namespace App;

use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;

use App\Models\ProjectsModel;


class ApiController extends AbstractController {

    /**
     * Index function
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function __invoke( Request $request, Response $response )
    {
        if( !$this->isLogged ) return json(['error' => ['code' => 'NotLogged', 'message' => 'User not logged']]); // check logged

        return json([]);
    }

    public function heartbeat( Request $request, Response $response )
    {
        $data = [];

        return json($data);
    }








//////// PROJECTS

    public function projectsList( Request $request, Response $response )
    {
        $data = [];

        $projects = [];
        
        if( $tryProjects = ProjectsModel::getAllByUser($this->userId) )
        {
            $projects = $tryProjects;
        }

        $data['projects'] = $projects;


        return json($data);
    }

    public function projectCreate( Request $request, Response $response )
    {
        $data = [];

        return json($data);
    }

    public function projectUpdate( Request $request, Response $response )
    {
        $data = [];

        return json($data);
    }

    public function projectDelete( Request $request, Response $response )
    {
        $data = [];

        return json($data);
    }



//////// CATEGORIES

    public function categoryCreate( Request $request, Response $response )
    {
        $data = [];

        return json($data);
    }

    public function categoryUpdate( Request $request, Response $response )
    {
        $data = [];

        return json($data);
    }

    public function categoryDelete( Request $request, Response $response )
    {
        $data = [];

        return json($data);
    }


//////// TASKS


    public function taskCreate( Request $request, Response $response )
    {
        $data = [];

        return json($data);
    }

    public function taskUpdate( Request $request, Response $response )
    {
        $data = [];

        return json($data);
    }

    public function taskDelete( Request $request, Response $response )
    {
        $data = [];

        return json($data);
    }



    



}
