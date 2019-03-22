<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 20/03/19
 * Time: 23:44
 */

namespace Anaxago\CoreBundle\Repository;

use Anaxago\CoreBundle\Entity\User;

/**
 * Class ProposalRepository
 * @package Anaxago\CoreBundle\Repository
 */
class ProposalRepository extends \Doctrine\ORM\EntityRepository
{

    public function countByUser(User $user)
    {
        return $this->createQueryBuilder('p')
            ->select('count(p.id)')
            ->join('p.user', 'u')->where('u.id= :id')->setParameter('id', $user->getId())
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findAllByUser(User $user, $page, $max)
    {
        $firstResult = ($page - 1) * $max;

        return $this->createQueryBuilder('p')
            ->select()
            ->join('p.user', 'u')->where('u.id= :id')->setParameter('id', $user->getId())
            ->setFirstResult($firstResult)
            ->setMaxResults($max)
            ->getQuery()
            ->getResult();
    }



}