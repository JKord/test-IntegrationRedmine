<?php
namespace IR\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\JsonResponse;

class BaseController extends Controller
{
    public function getResponse($code, $param = array())
    {
        $status = $this->container->getParameter('api_status');
        $obj = array('code' => $code, "message" => $status[$code]);

        return new JsonResponse(array_merge($obj, $param));
    }
}