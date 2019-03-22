<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 21/03/19
 * Time: 21:07
 */

namespace Anaxago\CoreBundle\Service\Api;


use Anaxago\CoreBundle\Entity\UserSession;
use Anaxago\CoreBundle\Repository\UserSessionRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Service d'authentification pour l'API
 *
 * Class AuthService
 * @package Anaxago\CoreBundle\Service\Api
 */
class AuthService
{

    const SALT = 'voiciunselquonnedoitpasd2couvrir';

    /**
     * protected $repository;

    /**
     * @var UserProviderInterface
     */
    protected $provider;

    protected $em;

    public function __construct(EntityManager $em, UserProviderInterface $provider)
    {
        $this->em = $em;
        $this->provider = $provider;
    }


    /**
     * @param $username
     * @param $password
     * @param null $ttl
     * @return array
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function authenticate($username, $password, $ttl = null)
    {

        $user = $this->provider->loadUserByUsername($username);
        if(!$user) {
            throw new UsernameNotFoundException('invalid user');
        }

        if (!password_verify($password, $user->getPassword())) {
            throw new UnsupportedUserException('invalid user!');
        }

        $accesToken = $this->generateNewAccessToken($username);

        $session = new UserSession();
        $session->setUser($user);
        $session->setAccessToken($accesToken);
        $session->setTokenType('Bearer');

        $dateTime   = new \DateTime();
        $expiration = $dateTime->add(new \DateInterval('PT' . (string) (int) $ttl . 'S'));
        $session->setExpirationDate($expiration);
        $session->setLastRefreshUserDate($dateTime);

        $user->eraseCredentials();
        $session->setSerializedUser(serialize($user));

        $this->em->persist($session);
        $this->em->flush();

        return [
          'token_type' => $session->getTokenType(),
            'access_token'=> $session->getAccessToken(),
            'expiraton_date'=> $session->getExpirationDate()
        ];
    }

    /**
     * @param $login
     * @return mixed
     * @throws \Exception
     */
    protected function generateNewAccessToken($login)
    {
        $date = new \DateTime();

        return str_replace('/','', base64_encode(hash('sha512', self::SALT . $login . $date->getTimestamp() . rand(0, 1000000))));
    }
}