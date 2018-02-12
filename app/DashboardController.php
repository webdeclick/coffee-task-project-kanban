<?php

namespace App;

use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;

use App\Models\ProjectsModel;
use App\Models\UserModel;
use App\Models\TasksModel;


/**
 * Dashboard Controller
 * Tasks and categories management
 *
 * @package  CoffeeTask
 * @version  v.1 (12/02/2018)
 * @author   rivetchip
 */
class DashboardController extends AbstractController {

    /**
     * Index function
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function __invoke( Request $request, Response $response, $projectId )
    {
        if( !$this->isLogged ) return redirect('/login?back=1'); // check logged

        $this->title = 'Dashboard';

        $userId = $this->userId;

        $this->projectId = $projectId;

        // find project :

        $project = ProjectsModel::find($projectId);

        if( !$project ) {
            return redirect('/projects?back=1'); // ce projet n'existe pas
        }

        // check persmission
        if( !$this->canAction('project', 'read', $projectId) ) {
            return redirect('/projects?cannotaccess=1');
        }

        // add vars

        $this->dashboard = $project;

        $this->project_admin = UserModel::find($project->linked_admin);

        // check user manager / admin

        $this->is_admin = ( $userId == $project->linked_admin );
        
        $this->is_manager = ( $userId == $project->linked_manager );

        // purge outdated tasks before fetching new

        $purge = $this->automaticPurge($projectId);


        return render('dashboard', $this->container);
    }


    /**
     * Display a picture for the uploaded files of a task
     *
     * @param Request $request
     * @param Response $response
     * @param int $fileid
     * @return void
     */
    public function filePicture( Request $request, Response $response, $fileid )
    {
        $uploadFolder = getcwd() . '/uploads/';

        $attachmentFolder = $uploadFolder.'files/';

        $default = 'file_default.png';

        $fileName = $attachmentFolder . $fileid; // FIXME security

        if( !is_readable($fileName) )
        {
            $fileName = $uploadFolder.$default;
        }

        list($resizeWidth, $resizeHeight) = [100, 100];

        // $fileType = mime_content_type($fileName);
        // $fileSize = filesize($fileName);

        list($imageWidth, $imageHeight, $imageType) = getimagesize($fileName);

        switch( $imageType )
        {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($fileName);
                $displayCallback = 'imagejpeg';
                $contentType = 'image/jpeg';
            break;

            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($fileName);
                $displayCallback = 'imagegif';
                $contentType = 'image/gif';
            break;

            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($fileName);
                $displayCallback = 'imagepng';
                $contentType = 'image/png';
            break;

            default:
                $image = imagecreatefromjpeg($fileName);
                $displayCallback = 'imagejpeg';
                $contentType = 'image/jpeg';
            break;
        }

        // $resizeWidth = 100;
        // $ratio = $resizeWidth / $imageWidth;
        // $resizeHeight = $imageHeight * $ratio;

        //ob_start();

        $new_image = imagecreatetruecolor($resizeWidth, $resizeHeight);

        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);

        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $imageWidth, $imageHeight);

        header('Content-Type:' . $contentType);

        call_user_func($displayCallback, $new_image);

        imagedestroy($new_image);

        // $result = ob_get_clean();

        exit;

        //header('Content-Length: ' . $fileSize);
        //exit(readfile($fileName));
    }




}
