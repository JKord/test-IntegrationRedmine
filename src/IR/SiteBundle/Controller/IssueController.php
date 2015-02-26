<?php
namespace IR\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\DependencyInjection\ContainerInterface,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class IssueController extends Controller
{
    private $redmineApi;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        $this->redmineApi = $this->get('ir.redmine_api');
    }

    /**
     * @Template()
     */
    public function indexAction($projectId)
    {
        $issuesByTracker = $this->redmineApi->getIssuesByTracker($projectId);

        return array(
            'projectName'     => $issuesByTracker['projectName'],
            'issuesByTracker' => $issuesByTracker['issues']
        );
    }
}