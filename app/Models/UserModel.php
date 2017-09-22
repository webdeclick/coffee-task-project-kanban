<?php

namespace App\Models;


class UserModel extends AbstractModel {

    protected $table = 'users';


    public static function getIdByLogin( $email, $password )
    {
        $model = ( new static );
        
        $dbh = $model->connection();

        $results = $dbh->single(
            'SELECT id FROM @users WHERE email = :email AND BINARY password = :password',
            [ 'email' => $email, 'password' => $password ]
        );

        return ( $results ?: null );
    }

    public static function getIdByEmail( $email )
    {
        $model = ( new static );
        
        $dbh = $model->connection();

        $results = $dbh->single(
            'SELECT id FROM @users WHERE email = :email',
            [ 'email' => $email ]
        );

        return ( $results ?: null );
    }

    public static function getAllFromProject( $projectId )
    {
        $model = ( new static );
        
        $dbh = $model->connection();

        $results = $dbh->all(
            'SELECT user_id FROM @users_has_projects WHERE project_id = :projectId',
            [ 'projectId' => $projectId ]
        );

        return ( $results ?: null );
    }




}
