<?php

namespace App;

use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;

use App\Models\ProjectsModel;


class ApiController extends AbstractController {

    protected function apiError( $code )
    {
        $messages = [
            'UserNotLogged' => 'User not logged',
            'ProjectNotExist' => 'Project does not exist',
            'ProjectNotCreated' => 'Project cannot be created',
        ];

        return json(['error' => [ 'code' => $code, 'message' => $messages[$code] ]]);
    }

    /**
     * Heartbeat function
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function heartbeat( Request $request, Response $response )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');

        $data = [];

        return json($data);
    }



//////// PROJECTS

    public function projectsList( Request $request, Response $response )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');

        $projects = ProjectsModel::getAllByUser($this->userId);

        return json([
            'projects' => $projects
        ]);
    }

    public function projectCreate( Request $request, Response $response )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');

        $pTitle = $request->input('title', '');
        $pDescription = $request->input('description', '');

        $pUsers = $request->input('users', '');
        $pUsers = preg_split("/\\r\\n|\\r|\\n/", $pUsers);

        $pUsers = array_unique($pUsers);

        $pManager = $request->input('manager', '');

        $data = [
            'title' => $pTitle,
            'description' => $pDescription,
            'manager' => $pManager,
            'users' => $pUsers,
        ];

        $userId = $this->userId;

        $project = ProjectsModel::createNew($userId, $data);

        if( $project ) {

            return json(['ok']);
        }

        return $this->apiError('ProjectNotCreated');
    }

    public function projectUpdate( Request $request, Response $response )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');

        $data = [];

        return json($data);
    }

    public function projectDelete( Request $request, Response $response, $projectId )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');

        $data = [];

        $project = ProjectsModel::find($projectId);

        if( $project ) {

            $project->delete();

            return json(['ok']);
        }
        else {
            return $this->apiError('ProjectNotExist');
        }

        return json($data);
    }



//////// CATEGORIES

    public function categoriesList( Request $request, Response $response, $projectId )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');

        $project = ProjectsModel::find($projectId);
        
        if( $project ) {

            $categories = ProjectsModel::findCategories($projectId);

            return json([
                'categories' => $categories
            ]);
        }

        return $this->apiError('ProjectNotExist');
    }

    public function categoriesTasksList( Request $request, Response $response, $projectId, $categoryId )
    {
        $data = [];
        







        
        return json($data);
    }


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

    public function taskGet( Request $request, Response $response, $taskId )
    {
        $data = [];

        return json($data);
    }

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
