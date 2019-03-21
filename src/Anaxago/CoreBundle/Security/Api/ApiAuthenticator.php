<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 21/03/19
 * Time: 18:20
 */

namespace Anaxago\CoreBundle\Security\Api;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\SimplePreAuthenticatorInterface;

/**
 * Authenticator à l'API
 *
 * Class ApiAuthenticator
 * @package Anaxago\CoreBundle\Security\Api
 */
class ApiAuthenticator implements SimplePreAuthenticatorInterface
{


    public function createToken(Request $request, $providerKey)
    {
        $user = 'anon';
        $credentials = $this->extractAccessToken($request);

        return new PreAuthenticatedToken($user, $credentials, $providerKey);
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {

        $accessToken = $token->getCredentials();
        $user = $userProvider->loadUserByUsername($accessToken);

        $token->setUser($user);

        return $token;
    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof PreAuthenticatedToken  && $token->getProviderKey() === $providerKey;
    }


    /**
     * extraire le jeton de sécurité de l'entpête Authorization
     *
     * @param Request $request
     * @return mixed|string|string[]|null
     */
    public function extractAccessToken(Request $request)
    {
        $accessToken = null;


        $obj = $request->headers;


        if($obj->has('Authorization')) {
            $accessToken = $obj->get('Authorization');
        }
        $accessToken = str_replace('Bearer ', '', $accessToken);

        return $accessToken;
    }
}