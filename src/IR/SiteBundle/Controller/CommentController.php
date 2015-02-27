<?php
namespace IR\SiteBundle\Controller;

class CommentController extends BaseController
{
    public function indexAction($projectId)
    {
        return $this->getResponse(1, array('comments' => array()));
    }

    public function addAction($projectId)
    {
        return $this->getResponse(1);
    }
}