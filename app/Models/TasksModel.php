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
    public static function getAllFromProjectCategoryUser( $projectId, $categoryId, $userId = null, $filter = null )
    {
        $dbh = DatabaseFactory();

        $is_deleted = ( $filter == 'delete' ); // deleted tasks
        $is_completed = ( $filter == 'archive' ); // complete tasks
        $is_olddate = ( $filter == 'olddate' ); // past end date

        $datetime = DatabaseDatetime(); // now

        $dateFilterSign = '>=';

        if( $is_olddate )
        {
            $dateFilterSign = '<';
        }

        $sql = 'SELECT * FROM @tasks t WHERE
            t.project_id = :projectId AND
            t.category_id = :categoryId AND
            t.is_deleted = :is_deleted AND
            t.is_completed = :is_completed AND
            ( t.end_at '.$dateFilterSign.' :datetime
        ';

        if( !$is_olddate ) {
            $sql .= ' OR t.end_at IS NULL '; // task with also no end dates
        }

        $sql .= ' ) ';

        $attributes = [
            'projectId' => $projectId,
            'categoryId' => $categoryId,
            'is_deleted' => $is_deleted,
            'is_completed' => $is_completed,
            'datetime' => $datetime
        ];

        if( $userId )
        {
            $sql .= ' AND assigned_to = :userId ';

            $attributes['userId'] = $userId;
        }

        $sql .= ' ORDER BY t.id ASC ';


        $results = $dbh->all($sql, $attributes);

        return ( $results ?: [] );
    }

    /**
     * Complete a task
     *
     * @return bool
     */
    public function complete()
    {
        $this->is_completed = true;

        $this->completed_at = DatabaseDatetime();


        $result = $this->save();

        return $result;
    }


}
