<?php

namespace App\Models;


class UserModel extends AbstractModel {

    const table = 'users';


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
            'SELECT u.id, u.fullname, u.email
            FROM @users u, @users_has_projects has
            WHERE has.project_id = :projectId
            AND u.id = has.user_id
            AND has.is_deleted = 0',

            [ 'projectId' => $projectId ]
        );

        return ( $results ?: null );
    }




}
