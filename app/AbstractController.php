<?php

namespace App;

use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;

use App\Models\UserModel;
use App\Models\ProjectsModel;
use App\Models\TasksModel;


/**
 * Abstract Controller
 */
abstract class AbstractController {

    protected $container = [];


    /**
     * Constructor
     *
     * @param array $container
     */
    public function __construct( array $container = [] )
    {
        $this->container = $container;

        $isLogged = false;
        $projects = null;
        $user = $userId = $avatar_url = null;

        if( session('isLogged') )
        {
            $isLogged = true;

            $userId = session('userId');

            $user = UserModel::find($userId);

            $projects = ProjectsModel::getAllByUser($userId);

            $avatar_url = '/avatar/'.$userId;
        }

        $this->userId = $userId;
        $this->user = $user;
        $this->avatar_url = $avatar_url;
        $this->isLogged = $isLogged;

        $this->projects = $projects;
    }

    /**
     * Rights ; check if the use has the right to do that action
     *
     * @param string $table ('create'/'update'/etc)
     * @param string $action ('project'/'task'/etc)
     * @param int|null $projectId (project id)
     * @param int|null  $tableId (id of the type)
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
                'update' => ['s','m','a'],
                'delete' => ['s','m','a'],
                'read_all' => ['m','a'], //
            ],
            'photos-folder' => [
                'read' => ['m','a'],
                'update' => ['m','a'],
                'delete' => ['m','a'],
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

                    if( $taskModel )
                    {
                        $assigned_to = $taskModel->assigned_to;
                        
                        if( $userId == $assigned_to ) {
                            $userPermissions[] = 's';
                        }
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
     * Semi-automatic purge of tasks / everything
     *
     * @return void
     */
    protected function automaticPurge( $projectId )
    {
        if( !$this->isLogged ) return;

        $userId = $this->userId;

        //$datetime = DatabaseDatetime(); // now

        // update old tasks

        TasksModel::automaticPurge($projectId);
    }




    ////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Dynamically get container attributes
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get( $key )
    {
        return ( isset($this->container[$key]) ? $this->container[$key] : null );
    }

    /**
     * Dynamically set container attributes
     *
     * @param  string  $key
     * @param  mixed   $value
     */
    public function __set( $key, $value )
    {
        //exceptions
        // if( in_array($key, ['errors']) )
        // {
        //     $this->container[$key][] = $value;
        // }

        $this->container[$key] = $value;
    }

    /**
     * Determine if a container attribute exists
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset( $key )
    {
        return isset($this->container[$key]);
    }

    /**
     * Unset a container attribute
     *
     * @param  string  $key
     * @return void
     */
    public function __unset( $key )
    {
        unset($this->container[$key]);
    }


}
