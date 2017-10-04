<?php

namespace App\Models;


class ProjectsModel extends AbstractModel {

    const table = 'projects';


    public static function getAllByUser( $userId )
    {
        $model = ( new static );
        
        $dbh = DatabaseFactory();

        // 'SELECT p.id as project_id
        // FROM @projects p, @users_has_projects has
        // WHERE
        //     ( has.user_id = :userId AND has.is_deleted = 0 ) OR ( p.linked_admin = :userId )
        //     AND p.id = has.project_id 
        //     AND p.is_deleted = 0
        // ORDER BY p.created_at',

        // if user is linked admin/mnanager or a simple user and has a linekd project to him

        $results = $dbh->all(
            'SELECT DISTINCT p.id as project_id, p.*
            FROM projects p
            LEFT JOIN users_has_projects has ON p.id = has.project_id
            WHERE
                ( has.user_id = :userId AND has.is_deleted = 0 )
                OR
                ( p.linked_manager = :userId OR p.linked_admin = :userId )
 
            AND p.is_deleted = 0
            ORDER BY p.created_at',

            [ 'userId' => $userId ]
        );

        $projects = [];

        if( !empty($results) )
        {
            foreach( $results as $result )
            {
                $project_id = $result['project_id'];

                $users = [];

                if( $tryUsers = UserModel::getAllFromProject($project_id) )
                {
                    $users = $tryUsers;
                }

                $result['users'] = $users;

                if( !empty($result['user_admin']) )
                {
                    $result['user_admin'] = UserModel::find($result['user_admin']);
                }

                if( !empty($result['user_manager']) )
                {
                    $result['user_manager'] = UserModel::find($result['user_manager']);
                }

                $projects[$project_id] = $result;
            }
        }

        return $projects;
    }





}
