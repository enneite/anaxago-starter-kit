<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 20/03/19
 * Time: 01:38
 */

namespace Anaxago\CoreBundle\Service\Api;


use Anaxago\CoreBundle\Entity\Proposal;
use Anaxago\CoreBundle\Entity\User;
use Anaxago\CoreBundle\Exception\ProjectNotFoundException;
use Anaxago\CoreBundle\Exception\ProposalAllreadyDoneException;
use Anaxago\CoreBundle\Model\Api\Mapping;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

use Anaxago\CoreBundle\Model\Api\Proposal as ApiProposal;
use Anaxago\CoreBundle\Model\Api\Project as ApiProject;

class ProposalService
{
    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * Proposal repository
     * @var EntityRepository
     */
    protected $repository;

    /**
     * project repository
     * @var EntityRepository
     */
    protected $projectRepository;

    public function __construct(EntityManager $em, EntityRepository $repository, EntityRepository $projetRepository)
    {
        $this->em = $em;
        $this->repository =$repository;
        $this->projectRepository = $projetRepository;
    }

    public function listProposals(User $user)
    {
        return [];
    }

    public function createProposal($projectId, User $user, array $content)
    {
        $projectEntity = $this->projectRepository->find($projectId);


        if(null == $projectEntity) {
            throw new ProjectNotFoundException('project not found');
        }
        $createdProposal = $this->repository->findBy(['user'=> $user, 'project' => $projectEntity]);
        if(null != $createdProposal) {
            throw new ProposalAllreadyDoneException('You have allready send a funding proposal for this project');
        }

        $entity = new Proposal();
        $entity->setUser($user);
        $entity->setProject($projectEntity);
        $entity->setAmount($content['amount']);
        $entity->setCurrency($content['currency']);
        $entity->setCreationDate(new \DateTime());
        $entity->setLastUpdate(new \DateTime());

        $this->em->persist($entity);
        $this->em->flush();

        //@fixme : reprendre le mapping par reflexion
        //Mapping::buildFromObject($proposal, $entity);
        $project = new ApiProject();
        $project = Mapping::buildFromObject($project, $projectEntity);
        $proposal = new ApiProposal();
        $proposal->setId($entity->getId());
        $proposal->setAmount($entity->getAmount());
        $proposal->setCurrency($entity->getCurrency());
        $proposal->setProject($project);


        return $proposal->toArray();
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