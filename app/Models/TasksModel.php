<?php

namespace App\Models;


class TasksModel extends AbstractModel {

    const table = 'tasks';


    /**
     * Get all taks with a project id, a category id, and an user id
     *
     * @param int $projectId
     * @param int $categoryId
     * @param int $userId
     * @return array
     */
    public static function getAllFromProjectCategoryUser( $projectId, $categoryId, $userId )
    {
        $dbh = DatabaseFactory();

        $results = $dbh->all(
            'SELECT t.*
            FROM @tasks t
            WHERE
                t.project_id = :projectId AND
                t.category_id = :categoryId AND
                t.assigned_to = :userId AND
                t.is_deleted = "0"',

            [ 'projectId' => $projectId, 'categoryId' => $categoryId, 'userId' => $userId ]
        );

        return ( $results ?: [] );
    }

    /**
     * Get all taks with a project id, a category id (admin)
     *
     * @param int $projectId
     * @param int $categoryId
     * @return array
     */
    public static function getAllFromProjectCategory( $projectId, $categoryId )
    {
        $dbh = DatabaseFactory();

        $results = $dbh->all(
            'SELECT *
            FROM @tasks
            WHERE
                project_id = :projectId AND
                category_id = :categoryId AND
                is_deleted = "0"',

            [ 'projectId' => $projectId, 'categoryId' => $categoryId ]
        );

        return ( $results ?: [] );
    }


}
