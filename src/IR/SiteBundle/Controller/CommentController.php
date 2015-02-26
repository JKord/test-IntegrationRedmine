<?php
namespace IR\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\JsonResponse;

class CommentController extends Controller
{
    public function indexAction($projectId)
    {
        return $this->getResponse(1, array('comments' => array()));
    }

    public function addAction($projectId)
    {
        return $this->getResponse(1);
    }

    public function getResponse($code, $param = array())
    {
        $status = $this->container->getParameter('api_status');
        $obj = array('code' => $code, "message" => $status[$code]);

        return new JsonResponse(array_merge($obj, $param));
    }
}