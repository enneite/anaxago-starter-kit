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
        if(!$this->getuser()) {
            return $this->sendJsonResponse(['message' => 'Authentication required'], 401);
        }
        return $this->sendJsonResponse($this->get('anaxago_core_service_api_proposal')->listProposals($this->getUser()));
    }

    /**
     * créer une proposition d'investissement
     *
     * @param $projectId
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function createAction($projectId)
    {
        if(!$this->getuser()) {
            return $this->sendJsonResponse(['message' => 'Authentication required'], 401);
        }
        return $this->sendJsonResponse($this->get('anaxago_core_service_api_proposal')->createProposal($projectId, $this->getUser()), 201);
    }

    /**
     * lire  une proposition d'investisssement
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function readAction($id)
    {
        if(!$this->getuser()) {
            return $this->sendJsonResponse(['message' => 'Authentication required'], 401);
        }
        return $this->sendJsonResponse($this->get('anaxago_core_service_api_proposal')->readProposal($id, $this->getUser()));
    }

    /**
     * modifier une proposition d'investisssement
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function updateAction($id)
    {
        if(!$this->getuser()) {
            return $this->sendJsonResponse(['message' => 'Authentication required'], 401);
        }
        return $this->sendJsonResponse($this->get('anaxago_core_service_api_proposal')->updateProposal($id, $this->getUser()));
    }

    /**
     * supprimer une proposition d'investisssement
     *
     * @param $id
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function deleteAction($id)
    {
        if(!$this->getuser()) {
            return $this->sendJsonResponse(['message' => 'Authentication required'], 401);
        }
        return $this->sendJsonResponse($this->get('anaxago_core_service_api_proposal')->deleteProposal($id, $this->getUser()), 204);
    }
}