<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 21/03/19
 * Time: 18:20
 */

namespace Anaxago\CoreBundle\Security\Api;


use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 *
 *
 * Class ApiUserProvider
 * @package Anaxago\CoreBundle\Security\Api
 */
class ApiUserProvider implements UserProviderInterface
{
    protected $repository;

    public function __construct($repository)
    {
        $this->repository         = $repository;
    }

    public function loadUserByUsername($username)
    {

        $user   = null;
        $entity = $this->repository->findOneBy(array('accessToken' => $username));

        if (null == $entity) {

            throw new UsernameNotFoundException('bad access token');
        }

        $date = new \DateTime();
        if ($entity->getExpirationDate() < $date) {
            throw new UnsupportedUserException('expired token');
        }
        return $user = $entity->getUser();

    }

    /**
     * @param UserInterface $user
     * @return UserInterface
     */
    public function refreshUser(UserInterface $user)
    {
        return $user;
    }

    public function supportsClass($class)
    {
        return $class === 'Anaxago\CoreBundle\Entity\User';
    }


}