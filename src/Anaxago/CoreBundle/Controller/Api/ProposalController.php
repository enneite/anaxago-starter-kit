<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 20/03/19
 * Time: 00:44
 */

namespace Anaxago\CoreBundle\Controller\Api;

use Anaxago\CoreBundle\Exception\ProjectNotFoundException;
use Anaxago\CoreBundle\Exception\ProposalAllreadyDoneException;
use Symfony\Component\HttpFoundation\Request;

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
    public function createAction(Request $request, $projectId)
    {
        try {
            if(!$this->getuser()) {
                return $this->sendJsonResponse(['message' => 'Authentication required'], 401);
            }
            $content = $this->getJsonContent($request);
            return $this->sendJsonResponse($this->get('anaxago_core_service_api_proposal')->createProposal($projectId, $this->getUser(), $content), 201);
        }
        catch(ProjectNotFoundException $e){
            return $this->sendJsonResponse(['message' => $e->getMessage()], 404);
        }
        catch(ProposalAllreadyDoneException $e){
            return $this->sendJsonResponse(['message' => $e->getMessage()], 403);
        }
        catch(\Exception$e) {
            return $this->sendJsonResponse(['message' => $e->getMessage()], 500);
        }

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