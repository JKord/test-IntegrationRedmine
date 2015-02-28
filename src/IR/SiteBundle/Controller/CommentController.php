<?php
namespace IR\SiteBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface,
    Symfony\Component\HttpFoundation\Request;

class CommentController extends BaseController
{
    private $repComment;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        $this->repComment = $this->get('ir.site.repository.comment');
    }

    public function indexAction($projectId)
    {
        return $this->getResponse(1, array('comments' => $this->repComment->findByProjectId($projectId)));
    }

    public function addAction(Request $request, $projectId)
    {
        $text = $request->get('text');
        if (empty($text)) {
            return $this->getResponse(4);
        }
        $this->repComment->add($text, $this->getUser()->getUsername(), $projectId);

        return $this->getResponse(1);
    }
}