<?php

namespace App\Models;


class FileModel extends AbstractModel {

    const table = 'files';


    /**
     * Get the file physical name, used in task to display files
     *
     * @return mixed
     */
    public function getFilename()
    {
        return $this->id;
    }

}
