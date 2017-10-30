<?php

namespace App\Models;


class TasksModel extends AbstractModel {

    const table = 'tasks';


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

    public static function getAllFromProjectCategoryUser( $projectId, $categoryId, $userId )
    {
        $dbh = DatabaseFactory();

        $results = $dbh->all(
            'SELECT *
            FROM @tasks
            WHERE
                project_id = :projectId AND
                category_id = :categoryId AND
                assigned_to = :userId AND
                is_deleted = "0"',

            [ 'projectId' => $projectId, 'categoryId' => $categoryId, 'userId' => $userId ]
        );

        return ( $results ?: [] );
    }




}
