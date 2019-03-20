<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 20/03/19
 * Time: 00:43
 */

namespace Anaxago\CoreBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;

/**
 * controleur gerant les projets diffusés par l'API
 *
 * Class ProjectController
 * @package Anaxago\CoreBundle\Controller\Api
 */
class ProjectController extends ApiController
{

    /**
     * liste des projets
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function listAction(Request $request)
    {
        $page   = $request->query->has('page') ? $request->query->get('page') : 1;
        $max = $request->query->has('max') ? $request->query->get('max') : 10;

        return $this->sendJsonResponse($this->get('anaxago_core_service_api_project')->listProjects($page, $max));
    }

    /**
     * lecture d'un projet
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function readAction($id)
    {
        return $this->sendJsonResponse($this->get('anaxago_core_service_api_project')->readProject($id));
    }


}