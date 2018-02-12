<?php

namespace App;

use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;

use App\Models\ProjectsModel;
use App\Models\FileModel;


/**
 * Projects Controller
 * Listing
 *
 * @package  CoffeeTask
 * @version  v.1 (12/02/2018)
 * @author   rivetchip
 */
class ProjectsController extends AbstractController {

    /**
     * Index function
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public function __invoke( Request $request, Response $response )
    {
        if( !$this->isLogged ) return redirect('/login?back=1'); // check logged

        $this->title = 'Projects';

        return render('projects', $this->container);
    }

    /**
     * Render photos fodler page for managers
     *
     * @param Request $request
     * @param Response $response
     * @param int $projectId
     * @return string
     */
    public function photosFolder( Request $request, Response $response, $projectId )
    {
        if( !$this->isLogged ) return redirect('/login?back=1'); // check logged

        $userId = $this->userId;

        $this->projectId = $projectId;

        $this->title = 'Photos';

        // check persmission
        if( !$this->canAction('photos-folder', 'read', $projectId) ) {
            exit; // cannot in a normal way
        }

        // find project :

        $project = ProjectsModel::find($projectId);

        if( !$project ) {
            return redirect('/projects?back=1'); // ce projet n'existe pas
        }

        $this->project = $project;

        // check user manager / admin

        $this->is_admin = ( $userId == $project->linked_admin );
        
        $this->is_manager = ( $userId == $project->linked_manager );


        return render('photos-folder', $this->container);
    }


}
