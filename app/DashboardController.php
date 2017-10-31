<?php

namespace App;

use Slim\Http\Interfaces\RequestInterface as Request;
use Slim\Http\Interfaces\ResponseInterface as Response;

use App\Models\ProjectsModel;


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

        $this->projectId = $projectId;

        // find project :

        $project = ProjectsModel::find($projectId);

        if( !$project ) {
            return redirect('/projects?back=1'); // ce projet n'existe pas
        }

        //todo : checker si l'user est dans ce projet

        return render('dashboard', $this->container);
    }





}
