<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 20/03/19
 * Time: 00:43
 */

namespace Anaxago\CoreBundle\Controller\Api;

/**
 * controleur gerant les projets diffusés par l'API
 *
 * Class ProjectsController
 * @package Anaxago\CoreBundle\Controller\Api
 */
class ProjectsController extends ApiController
{

    /**
     * liste des projets
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function listAction()
    {
        return $this->sendJsonResponse($this->get('anaxago_core_service_api_project')->listProjects());
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