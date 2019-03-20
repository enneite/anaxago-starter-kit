<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 20/03/19
 * Time: 00:44
 */

namespace Anaxago\CoreBundle\Controller\Api;

/**
 * controleur de l'API gérant les propositions
 *
 * Class ProposalController
 * @package Anaxago\CoreBundle\Controller\Api
 */
class ProposalController  extends ApiController
{
    /**
     * listed des propositions d'investissements faites par l'utilisateur connecté à l'API
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function listAction()
    {
        return $this->sendJsonResponse([]);
    }

    /**
     * créer une proposition d'investissement
     *
     * @param $projectId
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function createAction($projectId)
    {
        return $this->sendJsonResponse([], 201);
    }

    /**
     * lire  une proposition d'investisssement
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function readAction($id)
    {
        return $this->sendJsonResponse([]);
    }

    /**
     * modifier une proposition d'investisssement
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateAction($id)
    {
        return $this->sendJsonResponse([]);
    }

    /**
     * supprimer une proposition d'investisssement
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function deleteAction($id)
    {
        return $this->sendJsonResponse([], 204);
    }
}