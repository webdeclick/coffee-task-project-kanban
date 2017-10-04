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
            WHERE (
                ( has.user_id = :userId AND has.is_deleted = 0 )
                OR
                ( p.linked_manager = :userId OR p.linked_admin = :userId )
            )
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


                if( !empty($result['linked_admin']) )
                {
                    $user_admin = UserModel::find($result['linked_admin']);

                    if($user_admin)
                    {
                        $result['user_admin'] = [
                            'id' => $user_admin['id'],
                            'fullname' => $user_admin['fullname'],
                            'email' => $user_admin['email'],
                        ]; 
                    }
                }

                unset($result['linked_admin']);

                if( !empty($result['linked_manager']) )
                {
                    $user_manager = UserModel::find($result['linked_manager']);

                    if($user_manager)
                    {
                        $result['user_manager'] = [
                            'id' => $user_manager['id'],
                            'fullname' => $user_manager['fullname'],
                            'email' => $user_manager['email'],
                        ];  
                    }
                }

                unset($result['linked_manager']);

                $projects[$project_id] = $result;
            }
        }

        return $projects;
    }

    public static function createNew( $userId, array $data )
    {
        $dbh = DatabaseFactory();


        $linked_manager = null;

        if( !empty($data['manager']) )
        {
            $linked_manager = UserModel::getIdByEmail($data['manager']);
        }

        // create project

        $projectId = $dbh->execute(
            'INSERT INTO @projects SET
                linked_admin = :linked_admin,
                linked_manager = :linked_manager,
                title = :title,
                description = :description
            ',
            [
                'linked_admin' => $userId,
                'linked_manager' => $linked_manager,
                'title' => $data['title'],
                'description' => $data['description']
            ]
        );


        if( $projectId && is_array($data['users']) && !empty($data['users']) )
        {
            foreach($data['users'] as $key => $user_email )
            {
                if( empty($user_email) ) continue;

                $linked_user = UserModel::getIdByEmail($user_email);

                if( $linked_user ) {

                    $hasId = $dbh->execute(
                        'INSERT INTO @users_has_projects SET
                            user_id = :user_id,
                            project_id = :project_id
                        ',
                        [
                            'user_id' => $linked_user,
                            'project_id' => $projectId,
                        ]
                    );
                }
            }
        }

        return $projectId;
    }


    public function delete()
    {
        $dbh = DatabaseFactory();

        // delete has

        $results = $dbh->execute(
            'UPDATE @users_has_projects SET
                is_deleted = :is_deleted,
                deleted_at = :deleted_at
            WHERE project_id = :primaryKey',

            [
                'is_deleted' => '1',
                'deleted_at' => DatabaseDatetime(),
                'primaryKey' => $this->id
            ]
        );

        // delete project

        $results = parent::delete();

        return $results;
    }

    public static function findCategories( $projectId )
    {
        $dbh = DatabaseFactory();

        $results = $dbh->all(
            'SELECT * FROM @categories
            WHERE
                project_id = :projectId
                AND is_deleted = 0',

            ['projectId' => $projectId]
        );

        if( $results )
        {
            return ($results);
        }

        return [];
    }




}
