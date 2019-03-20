<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 20/03/19
 * Time: 00:46
 */

namespace Anaxago\CoreBundle\Controller\Api;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * classe abstraite pour mutualiser certaines méthodes de formatage
 *
 * Class ApiController
 * @package Anaxago\CoreBundle\Controller\Api
 */
abstract class ApiController extends Controller
{
    /**
     * @param array $data
     * @param int   $status
     *
     * @return JsonResponse
     */
    protected function sendJsonResponse(array $data, $status = 200, $headers=array())
    {
        $response = new JsonResponse($data);
        $response->setStatusCode($status);

        foreach($headers as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    }
}