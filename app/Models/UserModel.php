<?php

namespace App\Models;


class UserModel extends AbstractModel {

    const table = 'users';


    /**
     * Get user id, by it's password and email
     *
     * @param string $email
     * @param string $password
     * @return null|array
     */
    public static function getIdByLogin( $email, $password )
    {
        $dbh = DatabaseFactory();

        $results = $dbh->single(
            'SELECT id FROM @users WHERE email = :email AND BINARY password = :password AND is_deleted = :is_deleted',
            [ 'email' => $email, 'password' => $password, 'is_deleted' => '0' ]
        );

        return ( $results ?: null );
    }

    /**
     * Get user id by its email
     *
     * @param string $email
     * @return null|array
     */
    public static function getIdByEmail( $email )
    {
        $dbh = DatabaseFactory();

        $results = $dbh->single(
            'SELECT id FROM @users WHERE email = :email AND is_deleted = :is_deleted ',
            [ 'email' => $email, 'is_deleted' => '0' ]
        );

        return ( $results ?: null );
    }

    /**
     * List all user that are linked to a project id
     *
     * @param int $projectId
     * @return array
     */
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

    /**
     * Check if the user id as the project id
     *
     * @param int $projectId
     * @param int $userId
     * @return boolean
     */
    public static function hasProject( $projectId, $userId )
    {
        $dbh = DatabaseFactory();

        $results = $dbh->single(
            'SELECT DISTINCT p.id as project_id
            FROM @projects p
            LEFT JOIN @users_has_projects has ON p.id = has.project_id
            WHERE (
                ( has.user_id = :user_id AND has.is_deleted = 0 )
                OR
                ( p.linked_manager = :user_id OR p.linked_admin = :user_id )
            )
            AND p.id = :project_id
            AND p.is_deleted = :is_deleted',

            [ 'project_id' => $projectId, 'user_id' => $userId, 'is_deleted' => '0' ]
        );

        return ( $results ? true : false );
    }


}
