<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 21/03/19
 * Time: 21:20
 */

namespace Anaxago\CoreBundle\Controller;


use Anaxago\CoreBundle\Controller\Api\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Controleur pour gérer l'authentification à l'API
 *
 * Class AuthController
 * @package Anaxago\CoreBundle\Controller
 */
class AuthController extends ApiController
{

    /**
     * Authentication with password, login client
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function indexAction(Request $request)
    {

        try {
            $content = $this->getJsonContent($request);
            return $this->sendJsonResponse($this->authenticate($content), 200);
        } catch (\Exception $e) {
            return $this->sendJsonResponse(['message' => 'invalid login or password'], 401);
        }
    }

    /**
     * authentication process.
     *
     * @param $request
     *
     * @return mixed
     */
    protected function authenticate($content)
    {
        $ttl         = $this->getParameter('api_access_token_ttl');
        $accessInfos = $this->get('anaxago_core_service_api_auth')->authenticate($content['username'], $content['password'], $ttl);
        $protocol = 'http';
        $accessInfos['instance_url'] = $protocol . '://' . $_SERVER['SERVER_NAME'] . $this->getParameter('settings.api_route_prefix');

        return $accessInfos;
    }
}