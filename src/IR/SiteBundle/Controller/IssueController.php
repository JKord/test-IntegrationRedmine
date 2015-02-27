<?php
namespace IR\SiteBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerInterface,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template,
    Symfony\Component\HttpFoundation\Request;

class IssueController extends BaseController
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
        return array(
            'project'  => $this->redmineApi->getProject($projectId),
            'trackers' => $this->redmineApi->getTrackers()
        );
    }

    public function getIssuesByTrackerAction(Request $request, $projectId)
    {
        $trackerId = $request->get('trackerId');
        if (empty($trackerId)) {
            return $this->getResponse(4);
        }

        $issues = $this->redmineApi->getIssuesByTracker($projectId, $trackerId);
        $issuesHtml = $this->renderView('IRSiteBundle:Issue:issues.html.twig', array('issues' => $issues));

        return $this->getResponse(1, array('issuesHtml' =>  $issuesHtml));
    }
}