<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 22/03/19
 * Time: 17:19
 */

namespace Anaxago\CoreBundle\Listener\Doctrine;


use Anaxago\CoreBundle\Entity\Proposal;
use Anaxago\CoreBundle\Service\Api\ProposalService;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

class ProposalListener  implements EventSubscriber
{
    /**
     * ProposalListener constructor.
     */
    public function __construct()
    {

    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents(): array
    {
        return ['postUpdate'];
    }



    /**
     *
     * met à jour le statut du projet associé à la proposition de financement
     *
     * @param LifecycleEventArgs $args
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function postUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getEntity();
        // we only listen User entity
        if (!$entity instanceof Proposal) {
            return;
        }

        $project = $entity->getProject();
        if($project->getStatus() == 'OPEN') {
            $em = $args->getEntityManager();


            $query = $em->createQuery('SELECT SUM(p.amount) from Anaxago\CoreBundle\Entity\Proposal p JOIN p.project q WHERE q.id= :id');
            $query->setParameter('id', $project->getId());
            $sum = $query->getSingleScalarResult();
            if($sum>=$project->getAmount()) {
                $project->setStatus('FUNDED');
                $project->setReached(true);
                $em->persist($project);
                $em->flush();
            }


        }
    }

}