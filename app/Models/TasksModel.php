<?php

namespace App\Models;

use DateTime;


/**
 * Tasks model
 */
class TasksModel extends AbstractModel {

    const table = 'tasks';


    /**
     * Get all taks with a project id, a category id, and an user id
     * Default : when date is not over
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

        $is_file_validate = true;
        $is_file_deleted = false;


        $datetime = DatabaseDatetime(); // now

        $dateFilterSign = '>=';

        if( $is_olddate )
        {
            $dateFilterSign = '<';
        }

        $attributes = [
            'projectId' => $projectId,
            'categoryId' => $categoryId,
            'is_deleted' => $is_deleted,
            'is_completed' => $is_completed,
            'is_file_validate' => $is_file_validate,
            'is_file_deleted' => $is_file_deleted
        ];

        $sql = '
        SELECT t.*, (
            SELECT GROUP_CONCAT(f.id SEPARATOR "-")
            FROM @files f WHERE f.task_id = t.id
            AND is_deleted = :is_file_deleted AND is_validate = :is_file_validate
            ORDER BY f.id ASC
        ) files

        FROM @tasks t
        
        WHERE
            t.project_id = :projectId
            AND t.category_id = :categoryId
            AND t.is_deleted = :is_deleted
            AND t.is_completed = :is_completed
        ';
        //LEFT JOIN @files f ON f.task_id = t.id

        if( !$is_deleted && !$is_completed )
        {
            $sql .= ' AND ( t.end_at '.$dateFilterSign.' :datetime '; // to now

            if( !$is_olddate ) {
                $sql .= ' OR t.end_at IS NULL '; // task with also no end dates
            }

            $sql .= ' ) ';

            $attributes['datetime'] = $datetime;
        }

        if( $userId )
        {
            $sql .= ' AND assigned_to = :userId ';

            $attributes['userId'] = $userId;
        }

        $sql .= ' ORDER BY t.id ASC ';


        $results = $dbh->all($sql, $attributes) ?: [];

        // format taks :

        $dateTime = new DateTime;

        foreach($results as $key => $task )
        {
            $files = array();

            if( !empty($task['files']) )
            {
                $files = explode('-', $results[$key]['files']);
            }

            $results[$key]['files'] = $files;

            // add expire date ; if set

            if( isset($task['end_at']) )
            {
                $end_at = new DateTime($task['end_at']);
    
                $diff = $dateTime->diff($end_at);
    
                $results[$key]['days_expire'] = (float) $diff->format('%R%a'); //in days
            }
        }

        return $results;
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

    /**
     * Get simple stats from user
     *
     * @param int $projectId
     * @param int $userId
     * @return array
     */
    public static function getStatsSelf( $projectId, $userId )
    {
        $dbh = DatabaseFactory();

        $tasksSelf = $tasksTotal = 0;

        $tasksSelf = $dbh->single('
            SELECT count(t.id) as tasks_self
            FROM @tasks t
            WHERE
                t.project_id = :projectId
                AND t.assigned_to = :userId
                AND t.is_completed = "0"
                AND t.is_deleted = "0"
        ', [
            'projectId' => $projectId,
            'userId' => $userId
        ]);

        $tasksTotal = $dbh->single('
            SELECT count(t.id) as tasks_self
            FROM @tasks t
            WHERE
                t.project_id = :projectId
                AND t.is_completed = "0"
                AND t.is_deleted = "0"
        ', [
            'projectId' => $projectId
        ]);

        return [$tasksSelf, $tasksTotal];
    }




    /**
     * Mark all taks as old
     * 
     * @param int $userId
     * @param string $datetime
     * @return bool
     */
    public static function purgeOutdated( $projectId )
    {
	    $dbh = DatabaseFactory();

	    $datetime = DatabaseDatetime();


	    $result = $dbh->execute('
            UPDATE @tasks
            SET is_completed = "1", completed_at = :completed_at
            WHERE
                is_completed = "0" AND
                end_at IS NOT NULL AND
                end_at <= :date_now AND
                project_id = :projectId
        ', [
            'projectId' => $projectId, 'completed_at' => $datetime, 'date_now' => $datetime
        ]);

	    return $result;
    }


}

