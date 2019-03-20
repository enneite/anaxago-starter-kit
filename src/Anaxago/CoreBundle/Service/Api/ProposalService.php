<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 20/03/19
 * Time: 01:38
 */

namespace Anaxago\CoreBundle\Service\Api;


use Anaxago\CoreBundle\Entity\User;

class ProposalService
{
    protected $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function listProposals(User $user)
    {
        return [];
    }

    public function createProposal($projectId, User $user)
    {
        return [];
    }

    public function readProposal($id, User $user)
    {
        return [];
    }

    public function updateProposal($id, User $user)
    {
        return [];
    }

    public function deleteProposal($id, User $user)
    {
        return [];
    }
}