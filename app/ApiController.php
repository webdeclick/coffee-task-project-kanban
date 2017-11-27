<?php

namespace App;

use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;

use App\Models\UserModel;
use App\Models\ProjectsModel;
use App\Models\TasksModel;
use App\Models\CategoryModel;

use DateTime;


class ApiController extends AbstractController {

    /**
     * Api error message
     *
     * @param string $code
     * @return string
     */
    protected function apiError( $code )
    {
        $messages = [
            'CannotAction' => 'You don\'t have rights to perform this action',

            'UserNotLogged' => 'User not logged',
            'ProjectNotExist' => 'Project does not exist',
            'ProjectNotCreated' => 'Project cannot be created',
            'TaskNotCreated' => 'Task cannot be created',
            'TaskNotDeleted' => 'Task cannot be deleted',
            'TaskNotUpdated' => 'Task cannot be updated',
            'CategoryNotUpdated' => 'Category cannot be updated',
            'CategoryNotDeleted' => 'Category cannot be deleted',
        ];

        $message = $code;

        if( !empty($messages[$code]) ) {
            $message = $messages[$code];
        }

        return json(['error' => [ 'code' => $code, 'message' => $message ]]);
    }

    /**
     * Rights ; check if the use has the right to do that action
     *
     * @param string $table ('create'/'update'/etc)
     * @param string $action ('project'/'task'/etc)
     * @param string $projectId (project id)
     * @param mixed  $tableId (id of the type)
     * @return bool
     */
    protected function canAction( $table, $action, $projectId = null, $tableId = null )
    {
        $userId = $this->userId;

        // u:user ; h:user has project ; a:project admin ; m:project manager ; s:user task asignee
        $tablesPermissions = [
            'project' => [
                'read' => ['h'],
                'create' => ['u'],//anyone
                'update' => ['a'],
                'delete' => ['a'],
            ],
            'category' => [
                'read' => ['h','m','a'],
                'create' => ['m','a'],
                'update' => ['m','a'],
                'delete' => ['a'],
            ],
            'task' => [
                'read' => ['s','m','a'],
                'create' => ['h'],
                'update' => ['s'],
                'delete' => ['s','m','a'],
            ],
        ];

        $userPermissions = ['u'];

        if( isset($projectId) )
        {
            $projectModel = ProjectsModel::find($projectId);

            if( $projectModel ) // project exist
            {
                $userHasProject = UserModel::hasProject($projectId, $userId);
    
                $linked_admin = $projectModel->linked_admin;
                $linked_manager = $projectModel->linked_manager;
    
                if( $userHasProject ) {
                    $userPermissions[] = 'h';
                }
    
                if( $userId == $linked_admin ) {
                    $userPermissions[] = 'a';
                }
        
                if( $userId == $linked_manager ) {
                    $userPermissions[] = 'm';
                }
    
                if( $table == 'task' && isset($tableId) ) // search in task
                {
                    $taskModel = TasksModel::find($tableId);
    
                    $assigned_to = $taskModel->assigned_to;
    
                    if( $userId == $assigned_to ) {
                        $userPermissions[] = 's';
                    }
                }
            }
        }

        if( !empty($tablesPermissions[$table][$action]) )
        {
            $tablePermissions = $tablesPermissions[$table][$action];

            $result = !empty(array_intersect($userPermissions, $tablePermissions));

            return $result;
        }

        return false;
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

    /**
     * Get all projects
     *
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public function projectsList( Request $request, Response $response )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');

        $results = ProjectsModel::getAllByUser($this->userId);

        return json($results);
    }

    public function projectPeoples( Request $request, Response $response, $projectId )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');

        // check persmission
        if( !$this->canAction('project', 'read', $projectId) ) {
            return $this->apiError('CannotAction');
        }

        $results = ProjectsModel::getPeoples($projectId);
        
        return json($results);
    }

    public function projectCreate( Request $request, Response $response )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');

        // check persmission
        if( !$this->canAction('project', 'create') ) {
            return $this->apiError('CannotAction');
        }


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

            return json(['message'=>'ok']);
        }

        return $this->apiError('ProjectNotCreated');
    }

    public function projectUpdate( Request $request, Response $response, $projectId )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');

        // check persmission
        if( !$this->canAction('project', 'update', $projectId) ) {
            return $this->apiError('CannotAction');
        }









    }

    public function projectDelete( Request $request, Response $response, $projectId )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');

        // check persmission
        if( !$this->canAction('project', 'delete', $projectId) ) {
            return $this->apiError('CannotAction');
        }


        $project = ProjectsModel::find($projectId);

        if( $project ) {

            $project->delete();

            return json(['message'=>'ok']);
        }

        return $this->apiError('ProjectNotExist');
    }



//////// CATEGORIES

    public function categoriesList( Request $request, Response $response, $projectId )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');

        $project = ProjectsModel::find($projectId);
        
        if( $project ) {

            // check persmission
            if( !$this->canAction('category', 'read', $projectId) ) {
                return $this->apiError('CannotAction');
            }

            $categories = ProjectsModel::findCategories($projectId);

            return json($categories);
        }

        return $this->apiError('ProjectNotExist');
    }

    /**
     * Get tasks from a category and a project
     *
     * @param Request $request
     * @param Response $response
     * @param int $projectId
     * @param int $categoryId
     * @return string
     */
    public function categoriesTasksList( Request $request, Response $response, $projectId, $categoryId )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');

        // check persmission
        if( !$this->canAction('category', 'read', $projectId) ) {
            return $this->apiError('CannotAction');
        }

        // get task

        $userId = $this->userId;

        $results = TasksModel::getAllFromProjectCategoryUser($projectId, $categoryId, $userId);
        
        return json($results);
    }


    public function categoryCreate( Request $request, Response $response, $projectId )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');

        // check persmission
        if( !$this->canAction('category', 'create', $projectId) ) {
            return $this->apiError('CannotAction');
        }






        return json($data);
    }

    public function categoryUpdate( Request $request, Response $response, $categoryId )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');


        $category = CategoryModel::find($categoryId);

        if( $category )
        {
            $projectId = $category->project_id;

            // check persmission
            if( !$this->canAction('category', 'update', $projectId, $categoryId) ) {
                return $this->apiError('CannotAction');
            }

            // update model

            $title = $request->input('title', '');

            $category->title = $title;

            $result = $category->save();

            //if( $result ) FIXME
            {
                return json(['message'=>'ok']);
            }
        }

        return $this->apiError('CategoryNotUpdated');
    }

    public function categoryDelete( Request $request, Response $response, $categoryId )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');


        $category = CategoryModel::find($categoryId);
        
        if( $category )
        {
            $projectId = $category->project_id;

            // check persmission
            if( !$this->canAction('category', 'delete', $projectId, $categoryId) ) {
                return $this->apiError('CannotAction');
            }

            $result = $category->delete();

            //if( $result ) FIXME
            {
                return json(['message'=>'ok']);
            }
        }

        return $this->apiError('CategoryNotDeleted');
    }


//////// TASKS


    public function taskCreate( Request $request, Response $response, $projectId, $categoryId )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');

        // check persmission
        if( !$this->canAction('task', 'create', $projectId, $categoryId) ) {
            return $this->apiError('CannotAction');
        }


        $assignedTo = $request->input('newtask-field-people');

        if( empty($assignedTo) ) // if not assigned (0) set to self
        {
            $assignedTo = $this->userId;
        }

        $dateEndAt = $request->input('newtask-field-end-at');

        if( empty($dateEndAt) ) // current date + 1week
        {
            //$date = (new DateTime())->modify('+1 week');
            //$dateEndAt = $date->format('Y-m-d H:i:s');
            $dateEndAt = null;
        }

        $task = new TasksModel([
            'project_id' => $projectId,
            'category_id' => $categoryId,
            'assigned_to' => $assignedTo,

            'title' => $request->input('newtask-field-title'),
            'description' => $request->input('newtask-field-description'),
            'end_at' => $dateEndAt,
        ]);

        $taskId = $task->create();

        if( $taskId )
        {
            return json(['message'=>'ok', 'taskId' => $taskId]);
        }

        return $this->apiError('TaskNotCreated');
    }

    public function taskUpdate( Request $request, Response $response, $taskId )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');

        $userId = $this->userId;
        
        $task = TasksModel::find($taskId);

        if( $task )
        {
            $projectId = $task->project_id;

            // check persmission
            if( !$this->canAction('task', 'update', $projectId, $taskId) ) {
                return $this->apiError('CannotAction');
            }









        }

        







        return $this->apiError('TaskNotUpdated');
    }

    public function taskDelete( Request $request, Response $response, $taskId )
    {
        if( !$this->isLogged ) return $this->apiError('UserNotLogged');
        

        $userId = $this->userId;

        $task = TasksModel::find($taskId);

        if( $task )
        {
            $projectId = $task->project_id;

            // check persmission
            if( !$this->canAction('task', 'delete', $projectId, $taskId) ) {
                return $this->apiError('CannotAction');
            }

            // delete db

            $result = $task->delete();

            if( $result )
            {
                return json(['message'=>'ok']);
            }
        }
        
        return $this->apiError('TaskNotDeleted');
    }

    /*
    public function taskMove( Request $request, Response $response, $taskId, $projectId, $categoryId )
    {
        $data = [];




        return json($data);
    }
    */
    



}
