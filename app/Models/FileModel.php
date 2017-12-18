<?php

namespace App\Models;


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
     * @param mixed $filter
     * @return array
     */
    public static function getFilesFilter( $projectId, $filter = null )
    {
        $dbh = DatabaseFactory();

        $is_deleted = ( $filter == 'delete' );
        $is_not_validate = ( $filter == 'not_validate' );


        //TODO

        $sql = '
        SELECT f.*, 
        FROM @files f, 
        JOIN @tasks t ON f.task_id = t.id
        JOIN @projects p ON t.project_id = p.id
        WHERE
        
        ORDER BY t.id ASC
        ';

        $attributes = [
            'is_deleted' => $is_deleted,
            'is_validate' => ! $is_not_validate
        ];


        $results = $dbh->all($sql, $attributes);

        $files = [];

        foreach($results as $key => $file )
        {
            $fileid = $file['id'];

            $files[$fileid] = 
        }




    }


}
