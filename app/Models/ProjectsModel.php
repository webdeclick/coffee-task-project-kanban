<?php

namespace App\Models;


class ProjectsModel extends AbstractModel {

    protected $table = 'projects';


    public static function getAllByUser( $userId )
    {
        $model = ( new static );
        
        $dbh = DatabaseFactory();

        $projects = [];

// BUG users_has_projects

        $results = $dbh->all(
            'SELECT p.id as project_id
            FROM @projects p, @users_has_projects has
            WHERE
                ( has.user_id = :userId AND has.is_deleted = 0 ) OR ( p.linked_admin = :userId )
                AND p.id = has.project_id 
                AND p.is_deleted = 0
            ORDER BY p.created_at',

            [ 'userId' => $userId ]
        );

        if( !empty($results) )
        {
            foreach( $results as $result )
            {
                $project_id = $result['project_id'];
                $project = [];

                $users = [];

                if( $tryUsers = UserModel::getAllFromProject($project_id) )
                {
                    $users = $tryUsers;
                }

                $project['users'] = $users;

                if( isset($result['user_admin']) )
                {
                    $project['user_admin'] = UserModel::find($result['user_admin']);
                }

                if( isset($result['user_manager']) )
                {
                    $project['user_manager'] = UserModel::find($result['user_manager']);
                }
                
                $projects[$project_id] = $project;
            }
        }

        return ( $projects ?: null );
    }





}
