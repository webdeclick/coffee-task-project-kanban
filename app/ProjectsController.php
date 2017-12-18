<?php

namespace App;

use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;

use App\Models\ProjectsModel;
use App\Models\FileModel;


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
     * Validate pending uploaded tasks photos
     *
     * @param Request $request
     * @param Response $response
     * @param int $projectId
     * @return string
     */
    public function photosFolder( Request $request, Response $response, $projectId )
    {
        if( !$this->isLogged ) return redirect('/login?back=1'); // check logged

        // check persmission
        if( !$this->canAction('photos-folder', 'read', $projectId) ) {
            exit; // cannot in a normal way
        }


        $files = FileModel::getFilesFilter('not_validate');




        return render('photos-folder', $this->container);
    }


}
