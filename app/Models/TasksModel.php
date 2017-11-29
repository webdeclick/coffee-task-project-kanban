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
     * @param null|mixed $filter
     * @return array
     */
    public static function getAllFromProjectCategoryUser( $projectId, $categoryId, $userId, $filter = null )
    {
        $dbh = DatabaseFactory();

        $is_deleted = ( $filter == 'delete' );
        $is_completed = ( $filter == 'archive' );

        $results = $dbh->all(
            'SELECT t.*
            FROM @tasks t
            WHERE
                t.project_id = :projectId AND
                t.category_id = :categoryId AND
                t.assigned_to = :userId AND
                t.is_deleted = :is_deleted AND
                t.is_completed = :is_completed 
            ',
            [
                'projectId' => $projectId, 'categoryId' => $categoryId, 'userId' => $userId,
                'is_deleted' => $is_deleted, 'is_completed' => $is_completed
            ]
        );

        return ( $results ?: [] );
    }

    /**
     * Get all taks with a project id, a category id (admin)
     *
     * @param int $projectId
     * @param int $categoryId
     * @param null|mixed $filter
     * @return array
     */
    public static function getAllFromProjectCategory( $projectId, $categoryId, $filter = null )
    {
        $dbh = DatabaseFactory();

        $is_deleted = ( $filter == 'delete' );
        $is_completed = ( $filter == 'archive' );

        $results = $dbh->all(
            'SELECT *
            FROM @tasks t
            WHERE
                t.project_id = :projectId AND
                t.category_id = :categoryId AND
                t.is_deleted = :is_deleted AND
                t.is_completed = :is_completed 
            ',
            [
                'projectId' => $projectId, 'categoryId' => $categoryId,
                'is_deleted' => $is_deleted, 'is_completed' => $is_completed
            ]
        );

        return ( $results ?: [] );
    }

    public function complete()
    {
        $this->is_completed = true;

        $this->completed_at = DatabaseDatetime();


        $result = $this->save();

        return $result;
    }


}
