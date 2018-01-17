<?php

namespace App\Models;


/**
 * File model
 */
class FileModel extends AbstractModel {

    const table = 'files';


    /**
     * Get the file physical name, used in task to display files
     *
     * @return mixed
     */
    // public function getFilename()
    // {
    //     return $this->id;
    // }

    /**
     * Get all tasks photos based on a filter
     *
     * @param int $projectId
     * @param int $userId
     * @param mixed $filter
     * @return array
     */
    public static function getFilesFolderUnvalidate( $projectId, $userId )
    {
        $dbh = DatabaseFactory();

        $sql = '
        SELECT
            f.*,
            t.title task_title, t.description task_description, t.is_deleted task_deleted, t.is_completed task_completed,
            u.fullname user_fullname

        FROM @files f
        JOIN @tasks t ON f.task_id = t.id
        JOIN @users u ON t.assigned_to = u.id

        WHERE t.project_id = :projectId
        AND t.is_deleted = :task_is_deleted
        AND f.is_deleted = :file_is_deleted AND f.is_validate = :file_is_validate

        ORDER BY t.id ASC
        ';

        $attributes = [
            'projectId' => $projectId,
            'task_is_deleted' => false,
            'file_is_deleted' => false,
            'file_is_validate' => false
        ];

        $results = $dbh->all($sql, $attributes);

        $tasks = [];

        foreach($results as $key => $file )
        {
            $task_id = $file['task_id'];

            if( !isset($tasks[$task_id]) )
            {
                $tasks[$task_id] = [
                    'task_id' => $task_id,
                    'title' => $file['task_title'],
                    'description' => $file['task_description'],
                    'user_fullname' => $file['user_fullname'],
                    'is_completed' => boolval($file['task_completed']),
                    'is_deleted' => boolval($file['task_deleted']),
                    '__info' => 'FilesFolderUnvalidate'
                ];
            }

            $file = array_filter($file, function($key) { // remove prefixes from sql
                return (
                    strpos($key, 'task_') !== 0 &&
                    strpos($key, 'user_') !== 0
                );
            }, ARRAY_FILTER_USE_KEY);
            
            $tasks[$task_id]['files'][] = $file;
        }

        return $tasks;
    }


}
