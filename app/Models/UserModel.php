<?php

namespace App\Models;


class UserModel extends AbstractModel {

    protected $table = 'users';


    public static function getIdByLogin( $email, $password )
    {
        $dbh = DatabaseFactory();

        $results = $dbh->single(
            'SELECT id FROM @users WHERE email = :email AND BINARY password = :password',
            [ 'email' => $email, 'password' => $password ]
        );

        return ( $results ?: null );
    }

    public static function getIdByEmail( $email )
    {
        $dbh = DatabaseFactory();

        $results = $dbh->single(
            'SELECT id FROM @users WHERE email = :email',
            [ 'email' => $email ]
        );

        return ( $results ?: null );
    }

    public static function getAllFromProject( $projectId )
    {
        $dbh = DatabaseFactory();

        $results = $dbh->all(
            'SELECT user_id
            FROM @users_has_projects
            WHERE project_id = :projectId
            AND is_deleted = 0',

            [ 'projectId' => $projectId ]
        );

        return ( $results ?: null );
    }




}
